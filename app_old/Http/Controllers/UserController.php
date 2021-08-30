<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
  public function edit($id)
  {
      $user = User::findOrFail($id);
      return view('profile.edit', compact('user'));
  }
  public function update(Request $request, $id)
    {


        try{

            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' =>'required',
                //'role' => 'required',
                'avatar' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]);
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
            

            User::where('id', $id)->update($data);

            return redirect()->route('profile.edit',[$id])->with('success','User update successfully.');
        }catch( \Exception $e ){
          echo 'ssss';exit;
          print_r($e->getMessage());exit;
            return redirect()->route('profile.edit',[$id])->with('error',$e->getMessage());
            return "error: " .$e->getMessage();
        }
    }
}
