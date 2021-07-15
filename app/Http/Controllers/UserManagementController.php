<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
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
  public function index(Request $request)
  {
    $role=$this->role;
    $users=[];
    if($role==1)
      {
        $obj=new OrganizationController();
        $users=User::where('role','!=',1)->get();
        return view('user-management.index',compact('users','role'));
      }
      return view('user-management.index',compact('users','role'));

  }
  public function edit($id)
    {
        $user = User::with('role')->findOrFail($id);

        //print_r($user);exit;
        //$roles = $this->role;
        return view('user-management.edit', compact('user'));
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
}
