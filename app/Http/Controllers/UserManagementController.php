<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Permission;
use App\Models\User_permission;
use App\Http\Controllers\OrganizationController;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
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

    $role=$this->role;
    $users=[];
    if($role==1)
      {

        $users=User::where('role','!=',1)->get();
        return view('user-management.index',compact('users','role'));
      }
      if($role==2 && $org_id!="")
      {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $connection=$obj->org_connection($databaseName);
        $users=User::get();
      }
      return view('user-management.index',compact('users','role','org_id'));

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
          $validated = $request->validate([
            'recipientEmail' => 'required|email|max:255|unique:users,email',
            'name' => 'required'
        ]);

        //start create user

        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($request->organization);
        $connection=$obj->org_connection($databaseName);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->recipientEmail,
            'password' => '',
            'organization_id'=>$request->organization,
            'role'=>'3',
            'status' => 'pending_acceptance',

        ]);
        $permission=[];
        if($request->viewEdit == 'on'){
            $permission[]='view edit contact';
        }
        if($request->viewOnly == 'on'){
            $permission[]='view contact';
        }
        if($request->viewPassword == 'on'){
            $permission[]='view password';
        }

        if(!empty($permission))
        {
          foreach($permission as $perm)
          {
            $perm_id=Permission::select('id')->where('name','=',$perm)->get();
            $permissionId=$perm_id[0]->id;
            User_permission::create([
                'permission_id' => $permissionId,
                'user_id' => $user->id,
            ]);
          }

        }





        try {
          //  $status = Mail::to( $request->recipientEmail )->send( new InviteUser( $user ) );
            return redirect()->route('org-users-management.index',$request->organization)->with('success','User Invite Sent Successfully.');
        }catch ( \Exception $e ) {
            $user->delete();
            return redirect()->route('org-users-management.index',$request->organization)->with('error',$e->getMessage());
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
}
