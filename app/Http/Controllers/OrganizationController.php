<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Organisation;
use DB;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Config;

class OrganizationController extends Controller
{
    public function index()
    {
        echo '<h1>Organisation is created but listing is In progress</h1>';exit;
        $organisation=Organisation::where('superadmin_id','=',Auth::id())->get()->toArray();
        echo '<pre>';
        print_r($organisation);exit;
    }
    public function create()
    {
        return view('organization/create');
    }
    public function org_connection($databaseName)
    {
        Config::set("database.connections.mysql", [
            'driver' => 'mysql',
            "host" => "localhost",
            "database" => $databaseName,
            "username" => "root",
            "password" => "",
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ]);
    }
    public function store(Request $request)
    {
        try{
                $obj=new QueryController();
                $superAdminId=Auth::id();
                $org_name=$request->input('display_name');
                // $org_db_name=$request->input('display_name');
                $inputs = $request->all();
                $inputs['superadmin_id']=Auth::id();
                $inputs['org_name']=$org_name;
                //$inputs['org_db_name']=Auth::id();
                if($data=Organisation::create($inputs))
                    {
                        $databaseName=$data->id.'_'.$org_name;
                        if($return=$obj->createDb($databaseName))
                        {
                            $connection=$this->org_connection($databaseName);
                            Organisation::create($inputs);
                            

                        }
                        
                    }
                    return redirect('/organization');
                    
            }catch (Exception $e) {
                DB::rollback();
               // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);
                        
            } catch(\Illuminate\Database\QueryException $ex){ 
                print_r($ex->getMessage());
                DB::rollback();
               // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);
                         
            }
    }       
}
