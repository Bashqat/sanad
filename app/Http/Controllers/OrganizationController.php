<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Organisation;
use App\Models\MasterOrganisation;
use App\Models\User;
use App\Models\Org_setting;
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
        $organisations=MasterOrganisation::where('superadmin_id','=',Auth::id())->get();
        $user=User::where('id',Auth::id())->get();
        $user_name=$user[0]->name;


        return view('organisation.index', compact('organisations','user_name'));
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
            "password" => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ]);
        DB::purge('mysql');
        return $databaseName;
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
                $org_input=[
                            'org_db_name' => str_replace(' ', '', $org_name),
                            'superadmin_id' => Auth::id(),
                            'org_name'=>$org_name,
                        ];
                        
                if($data=MasterOrganisation::create($org_input))
                    {
                        $inputs['org_id']=$data->id;

                        $databaseName=$data->id.'_'.$org_name;
                        $databaseName=str_replace(' ', '', $databaseName);
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
            $orgData=MasterOrganisation::where('id','=',$org_id)->get();
            $databaseName=$org_id.'_'.$orgData[0]->org_db_name;
            //echo $databaseName;exit;


            $countries=CountryListFacade::getList('en');
            $organisationType=$this->organizationTypes();
            $busType=$this->businessTypes();
            $connection=$this->org_connection($databaseName);
            //echo $connection;exit;
            //$database = Config::get('database.connections.mysql');
            //echo DB::connection()->getDatabaseName();exit;
            //dd($database);

            $orgInfo=Organisation::where('org_id','=',$org_id)->get();

            //echo '<pre>';
            //print_R($orgInfo);exit;
            return view('organisation/create',['organisation_data'=>$orgInfo,'organisationType'=>$organisationType,'busType'=>$busType,'countries'=>$countries]);

        }catch (Exception $e) {
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);

        } catch(\Illuminate\Database\QueryException $ex){
            print_r($ex->getMessage());
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);

        }

    }
    public function get_db_name($org_id)
    {
            $db=MasterOrganisation::where('id','=',$org_id)->get();
            $databaseName=$org_id.'_'.$db[0]->org_db_name;
            return $databaseName;
    }
    public function update(Request $request)
    {
        try{
            $request->except('_token');
            $inputs = $request->all();
            $org_db_id=$request->input('org_id');
            $databaseName=$this->get_db_name($org_db_id);
            $connection=$this->org_connection($databaseName);

            $org_id=$request->input('id');

            if(Organisation::where('id', $org_id)->update(Arr::except($request->all(), ['_token','org_id'])))
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

        if(MasterOrganisation::where('id','=',$org_id)->delete())
        {
            return redirect()->route('org_list')->with('success','Organization delete successfully.');
        }


    }
    public function setting($org_id)
    {
      $databaseName=$this->get_db_name($org_id);
      $connection=$this->org_connection($databaseName);
      $data=Org_setting::get();
      return view('organisation/setting',['org_id'=>$org_id,'smtp_data'=>$data]);
    }
    public function settingUpdate(Request $request)
    {
      try{

        $databaseName=$this->get_db_name($request->org_id);
        $connection=$this->org_connection($databaseName);
        $data=Org_setting::get()->toArray();
        if(empty($data))
        {
          Org_setting::create(Arr::except($request->all(), ['_token','org_id']));
        }
        else {
            Org_setting::where('id', $data[0]['id'])->update(Arr::except($request->all(), ['_token','org_id','id']));
          }
          return redirect()->back()->with('success','Smtp detail updated successfully');
        }catch( \Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());

        }
      }


}
