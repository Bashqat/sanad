<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master_setting;
use Auth;

class MasterController extends Controller
{
    public function index()
    {
        $user_id=Auth::id();
        $data=Master_setting::where('user_id','=',$user_id)->get();
        return view('master/setting',['setting'=>$data]);
    }
    public function updateSetting(Request $request)
    {
        try{
                echo 'aaaa';exit;
        
                $user_id=$request->input('user_id');
                $data=Master_setting::where('user_id','=',$user_id)->get()->toArray();
                
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
                        if(Master_setting::create($update))
                        {
                            return response()->json(['status'=>'success','msg'=>'Data update successfully']);
                        }
                }
                else{
                        $update=[];
                        foreach($request->request as $key=>$value)
                        {
                            if($key!='_token' && $key!='user_id')
                            {
                                $update[$key]=$value;
                            }
                            
                        }
                    
                        if(Master_setting::where('user_id', $user_id)->update($update))
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
