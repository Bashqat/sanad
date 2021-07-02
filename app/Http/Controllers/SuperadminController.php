<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin_setting;
use Auth;

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
        $superAdmin_id=$request->superadmin_id;
        $data=SuperAdmin_setting::where('superadmin_id','=',$superAdmin_id)->get()->toArray();
        
        if(empty($data))
        {
            SuperAdmin_setting::create([
                'pin' => $request->pin,
                'superadmin_id' => $request->superadmin_id,
                
                
            ]);
        }
        else{
            SuperAdmin_setting::where('superadmin_id', $superAdmin_id)->update([
                    'pin' => $request->pin,
                    'superadmin_id' => $request->superadmin_id,
                    
                ]);
        }

        return redirect()->route('setting');
    }
}
