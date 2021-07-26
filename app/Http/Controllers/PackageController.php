<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use DB;

class PackageController extends Controller
{
    public function create($id='')
    {
      $package_data=[];
      if(isset($id) && $id!="")
      {
        $package_data=Package::where('id',$id)->get();
      }
      return view('package/create',compact('package_data'));
    }
    public function list()
    {
      $packages=Package::get();
      return view('package/list',compact('packages'));
    }

    public function store(Request $request)
    {
      try {
        $data['name']=$request->input('name');
        $data['price']=$request->input('price');
        $data['storage_per_org']=$request->input('storage_per_org');
        $data['invite_user_count']=$request->input('invite_user_count');
        $data['contact_count']=$request->input('contact_count');
        $data['third_party_api']=json_encode($request->input('third_party_api'));
        if(Package::create($data))
        {
          return redirect()->route('package.list')->with('success','Package added successfully.');
        }


      } catch (Exception $ex) {
        return redirect()->back()->with('error',$ex->getMessage());
        DB::rollback();
      } catch(\Illuminate\Database\QueryException $ex){
          return redirect()->back()->with('error',$ex->getMessage());
          DB::rollback();
      }

    }
    public function update(Request $request)
    {
      try {
          $data['name']=$request->input('name');
          $data['price']=$request->input('price');
          $data['storage_per_org']=$request->input('storage_per_org');
          $data['invite_user_count']=$request->input('invite_user_count');
          $data['contact_count']=$request->input('contact_count');
          $data['third_party_api']=json_encode($request->input('third_party_api'));
          $package_id=$request->input('package_id');

          if(Package::where('id', $package_id)->update($data))
              {
                return redirect()->route('package.list')->with('success','Package updated successfully.');
              }
      } catch (Exception $ex) {
        return redirect()->back()->with('error',$ex->getMessage());
        DB::rollback();
      } catch(\Illuminate\Database\QueryException $ex){
          return redirect()->back()->with('error',$ex->getMessage());
          DB::rollback();
      }
    }
    public function delete(Request $request)
    {
      try {
          $package_id=$request->input('package_id');
          
          if(Package::where('id', $package_id)->delete())
              {
                return redirect()->route('package.list')->with('success','Package deleted successfully.');
              }
      } catch (Exception $ex) {
        return redirect()->back()->with('error',$ex->getMessage());
        DB::rollback();
      } catch(\Illuminate\Database\QueryException $ex){
          return redirect()->back()->with('error',$ex->getMessage());
          DB::rollback();
      }

    }
}
