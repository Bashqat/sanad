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
        $user_id=$request->input('user_id');
        $data=Master_setting::where('user_id','=',$user_id)->get()->toArray();
        
        if(empty($data))
        {
            $update=[];
                foreach($request->request as $key=>$value)
                {
                    if($key!='_token')
                    $update[$key]=$value;
                }
                if(Master_setting::create($update))
                {
                    echo json_encode(['status'=>'success']);
                }
        }
        else{
                $update=[];
                foreach($request->request as $key=>$value)
                {
                    if($key!='_token' && $key!='user_id')
                    $update[$key]=$value;
                }
            
                if(Master_setting::where('user_id', $user_id)->update($update))
                {
                    echo json_encode(['status'=>'success']);
                }
           
                    
        }
        
    }
}
