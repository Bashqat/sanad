<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Organisation;
use DB;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Arr;
use Monarobase\CountryList\CountryListFacade;
use Timezonelist;

class OrganizationController extends Controller
{
    public function __construct()
    {
        //$org_db=Organisation::where('superadmin_id','=',Auth::id())->get();

    }
    public function index()
    {
        //echo '<h1>Organisation is created but listing is In progress</h1>';exit;
        
        
        $organisations=Organisation::where('superadmin_id','=',Auth::id())->get();
        return view('organisation.index', compact('organisations'));
        //echo '<pre>';
        //print_r($organisation);exit;
    }
    public function create()
    {
        $timezone_list =Timezonelist::create('current_date_utc_format', null, 'id="timezone" class="form-control select2"');
       
        //print_r($timezone_list);exit;
        $countries=CountryListFacade::getList('en');
        
        $organisationType=$this->organizationTypes();
        $busType=$this->businessTypes();
        
        return view('organisation/create',['organisationType'=>$organisationType,'busType'=>$busType,'countries'=>$countries,'timezone_list'=>$timezone_list]);
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
                    return redirect('/organisation');
                    
            }catch (Exception $e) {
                DB::rollback();
               // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);
                        
            } catch(\Illuminate\Database\QueryException $ex){ 
                print_r($ex->getMessage());
                DB::rollback();
               // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);
                         
            }
    }  
    
    public function edit($org_id)
    {
        try{
            $countries=CountryListFacade::getList('en');
            $organisationType=$this->organizationTypes();
            $busType=$this->businessTypes();
            $orgData=Organisation::where('id','=',$org_id)->get();
            // echo '<pre>';
            // print_R($orgData[0]->display_name);exit;
            return view('organisation/create',['organisation_data'=>$orgData,'organisationType'=>$organisationType,'busType'=>$busType,'countries'=>$countries]);
            
        }catch (Exception $e) {
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);
                    
        } catch(\Illuminate\Database\QueryException $ex){ 
            print_r($ex->getMessage());
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);
                    
        }

    }
    public function update(Request $request)
    {
        try{
            $request->except('_token');
            $inputs = $request->all();
            $org_id=$request->input('id');
            
            if(Organisation::where('id', $org_id)->update(Arr::except($request->all(), ['_token'])))
               {
                return redirect('/organisation');
               }
            
            
        }catch (Exception $e) {
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);
                    
        } catch(\Illuminate\Database\QueryException $ex){ 
            print_r($ex->getMessage());
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);
                    
        }

    }
    public function destroy( Request $request)
    {
        $org_id=$request->input('id');
        if(Organisation::where('id','=',$org_id)->delete())
        {
            return redirect()->route('org_list')->with('success','Organization delete successfully.');
        }
        
        
    }
}
