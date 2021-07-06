<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin_setting;
use Auth;
use DB;

class SuperadminController extends Controller
{
    public function index()
    {
        $superadmin_id=Auth::id();
        $data=SuperAdmin_setting::where('superadmin_id','=',$superadmin_id)->get();
        return view('superadmin/setting',['setting'=>$data]);
    }
    public function updateSetting(Request $request)
    {
        try{

            $superadmin_id=$request->input('superadmin_id');
            $data=SuperAdmin_setting::where('superadmin_id','=',$superadmin_id)->get()->toArray();
            
            if(empty($data))
            {
                $update=[];
                    foreach($request->request as $key=>$value)
                    {
                        if($key!='_token')
                        {
                            $update[$key]=$value;
                        }
                        
                    }
                    if(SuperAdmin_setting::create($update))
                    {
                        return response()->json(['status'=>'success','msg'=>'Data update successfully']);
                    }
            }
            else{
                    $update=[];
                    foreach($request->request as $key=>$value)
                    {
                        if($key!='_token' && $key!='superadmin_id')
                        {
                            $update[$key]=$value;
                        }
                        
                    }
                
                    if(SuperAdmin_setting::where('superadmin_id', $superadmin_id)->update($update))
                    {
                        return response()->json(['status'=>'success','msg'=>'Data update successfully']);
                    
                    }
            
                        
            }
        }catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);
                    
        } catch(\Illuminate\Database\QueryException $ex){ 
            DB::rollback();
            return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);
                     
        }
    }
}
