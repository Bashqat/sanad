<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Permission;
use App\Models\User_permission;
use App\Http\Controllers\OrganizationController;
use Illuminate\Validation\Rule;
use App\Lib\Email;
use App\Models\Org_setting;
use URL;

class UserManagementController extends Controller
{
  use Email;
  protected $id,$userData;
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
        $this->id = Auth::id();
        $this->userData=User::where('id',$this->id)->get();
        $this->role=$this->userData[0]->role;
        return $next($request);
    });
  }
  public function index(Request $request,$org_id='')
  {
    //$obj=new Email();


    $role=$this->role;
    $users=[];
    $tittle='';
    if($role==1)
      {
        $tittle="Sanad | Subscription and billing";
        $users=User::where('role','!=',1)->get();
        return view('user-management.index',compact('users','role'));
      }
      if($role==2 && $org_id!="")
      {
        $tittle="Sanad | User management";
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $connection=$obj->org_connection($databaseName);
        $users=User::get();
      }
      return view('user-management.index',compact('users','role','org_id','tittle'));

  }
  public function edit($id)
    {
      try{
        $user = User::with('role')->findOrFail($id);

        return view('user-management.edit', compact('user'));
      }catch( \Exception $e ){
          return redirect()->back()->with('error',$e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required',
                Rule::unique('users')->ignore($id),
            ],

            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        try{
            if( isset( $request->removeProfile ) && $request->removeProfile == "true" ){
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => 'user-avatar.png'
                ];
            }elseif( isset( $request->avatar ) ){
                $img = $request->avatar;
                $imageName = time().'.'.$img->extension();
                $img->move(public_path('images/profile'), $imageName);
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => $imageName
                ];
            }else{
                $data = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
            }
            $id=$request->id;

            User::where('id',$id)->update($data);

            // if( isset($request->edit_type) && $request->edit_type == 'admin_edit' ){
            //
            //     $status = Mail::to($request->email)->send( new UpdateUser( $data ) );
            //     return redirect()->route('profile.edit',[$id])->with('success','User update successfully.');
            // }
            return redirect()->back()->with('success','User update successfully.');
        }catch( \Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());
            return "error: " .$e->getMessage();
        }
    }
  public function bulkdestroy(Request $request){

        $ids = $request->idArr;
        $org_status=$request->org_status;
        if($org_status=="org_selected")
        {
          $obj=new OrganizationController();
          $org_id=$request->org_id;
          $databaseName=$obj->get_db_name($org_id);
          $connection=$obj->org_connection($databaseName);

          User::whereIn('id', $ids)->delete();
          return response()->json([
              'success' => 2,
              'msg' => "User deleted successfully"
          ]);

          }

        try {
            User::whereIn('id', $ids)->delete();
            redirect()->back()->with('success','User deleted successfully.');
            return response()->json([
                'success' => 1,
                'msg' => "User deleted successfully"

            ]);

        }catch ( \Exception $e ) {
            return response()->json([
                'success' => 0,
                'msg' => $e->getMessage()
            ]);
        }

    }

    public function destroy(Request $request,$id)
    {

      User::where('id', $id)->delete();
      return redirect()->back()->with('success','User deleted successfully.');
    }
    public function inviteUser(Request $request,$org_id)
    {
      return view('user-management.invite-user-view',compact('org_id'));
    }
    public function inviteUserSave(Request $request)
    {
        try {


              $validated = $request->validate([
                'recipientEmail' => 'required|email|max:255|unique:users,email',
                'name' => 'required'
            ]);
            $obj=new OrganizationController();
            $databaseName=$obj->get_db_name($request->organization);
            $connection=$obj->org_connection($databaseName);
            $length = 10;
            $token = bin2hex(random_bytes($length));
            $link=URL::to('organisation/'.$request->organization.'/verify').'/'.$token;

            $user = User::create([
              'name' => $request->name,
              'email' => $request->recipientEmail,
              'password' => '',
              'organization_id'=>$request->organization,
              'role'=>$request->role,
              'status' => 'pending_acceptance',
              'remember_token'=>$token,

          ]);

          $permission=[];

          if($request->contact != ''){
              $permission[]=$request->contact;
          }
          if($request->viewPassword != ''){
              $permission[]=$request->viewPassword ;
          }
          if($request->invoice != ''){
              $permission[]=$request->invoice;
          }
          if($request->invoicePayment != ''){
              $permission[]=$request->invoicePayment;
          }
          if($request->quote != ''){
              $permission[]=$request->quote;
          }
          if($request->journals != ''){
              $permission[]=$request->journals;
          }
          if($request->dateLocking != ''){
              $permission[]=$request->dateLocking;
          }
          if($request->report != ''){
              $permission[]=$request->report;
          }
          $group_contact_permission='';
          if(!empty($request->group_contact_access))
          {
            $group_contact_permission=json_encode($request->group_contact_access);
          }
          $permissionId=[];
          if(!empty($permission))
          {
            foreach($permission as $perm)
            {
              $perm_id=Permission::select('id')->where('slug','=',$perm)->get();
              $permissionId[]=$perm_id[0]->id;

            }

          }

          if(!empty($permissionId))
          {
            User_permission::create([
                'permission_id' => json_encode($permissionId),
                'user_id' => $user->id,
                'group_contact_permission'=>$group_contact_permission
            ]);
          }

            $setting=Org_setting::get()->toArray();
            if(!empty($setting[0]['smtp_email']))
            {
              $data=$this->email($request->name,$request->recipientEmail,$link,$request->organization);
            }


            return redirect()->route('org-users-management.index',$request->organization)->with('success','User Invite Sent Successfully.');
        }catch ( \Exception $e ) {
            //$user->delete();
            return redirect()->route('org-users-management.index',$request->organization)->with('error',$e->getMessage());
        }catch(\Illuminate\Database\QueryException $ex){
            print_r($ex->getMessage());
            DB::rollback();
        }

    }
    public function orgUseredit($org_id,$user_id)
    {

      try{
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $connection=$obj->org_connection($databaseName);
          $user = User::findOrFail($user_id);

        return view('user-management.edit', compact('user','org_id','user_id'));
      }catch( \Exception $e ){
          return redirect()->back()->with('error',$e->getMessage());
        }
    }
    public function orgUserUpdate(Request $request)
    {
        $id=$request->id;
        $org_id=$request->org_id;


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required',
              //  Rule::unique('users')->ignore($id),
            ],

            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        try{
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $connection=$obj->org_connection($databaseName);

            if( isset( $request->removeProfile ) && $request->removeProfile == "true" ){
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => 'user-avatar.png'
                ];
            }elseif( isset( $request->avatar ) ){
                $img = $request->avatar;
                $imageName = time().'.'.$img->extension();
                $img->move(public_path('images/profile'), $imageName);
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'avatar' => $imageName
                ];
            }else{
                $data = [
                    'name' => $request->name,
                    'email' => $request->email
                ];
            }
            $id=$request->id;
            

            User::where('id',$id)->update($data);

            // if( isset($request->edit_type) && $request->edit_type == 'admin_edit' ){
            //
            //     $status = Mail::to($request->email)->send( new UpdateUser( $data ) );
            //     return redirect()->route('profile.edit',[$id])->with('success','User update successfully.');
            // }
            return redirect()->back()->with('success','User update successfully.');
        }catch( \Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());
            return "error: " .$e->getMessage();
        }
    }

    public function orgUserDestroy($org_id,$user_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $connection=$obj->org_connection($databaseName);
      User::where('id', $user_id)->delete();
      return redirect()->back()->with('success','User deleted successfully.');
    }
    public function veryfyToken($org_id,$token)
    {
      try{
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $connection=$obj->org_connection($databaseName);
          $data=User::where('remember_token',$token)->get()->toArray();
          if(empty($data))
          {
            return redirect()->route('org-users-management.invalid')->with('error','Invalid url');
          }
          $update=User::where('remember_token',$token)->update(['status'=>'active','remember_token'=>'']);
          return redirect()->route('org-users-management.index',$org_id)->with('success','Your account is verified');
        }catch( \Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());
            return "error: " .$e->getMessage();
        }
    }
    public function orgUserChangeStatus($org_id,$user_id)
    {
        try{
            $obj=new OrganizationController();
            $databaseName=$obj->get_db_name($org_id);
            $connection=$obj->org_connection($databaseName);
            $data=User::select('status')->where('id',$user_id)->get()->toArray();
            $status=$data[0]['status'];

            //$update_status='active';
            if($status=="active")
            {
              $update_status='suspended';
            }elseif($status=="suspended")
            {
              $update_status='active';
            }

        $update=User::where('id',$user_id)->update(['status'=>$update_status]);
        return redirect()->route('org-users-management.index',$org_id)->with('success','Account is '.$update_status);
      }catch( \Exception $e ){
          return redirect()->back()->with('error',$e->getMessage());
          return "error: " .$e->getMessage();
      }
    }
    public function invalid()
    {
      return view('user-management.invalid_url');
    }

}
