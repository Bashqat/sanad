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
use Str;

class OrganizationController extends Controller
{
    public function __construct()
    {
        //$org_db=Organisation::where('superadmin_id','=',Auth::id())->get();

    }
    public function index()
    {

        $organisations=MasterOrganisation::with('user_detail')->where('superadmin_id','=',Auth::id())->get();
        if(Auth::user()->role==1)
          {
            $organisations=MasterOrganisation::with('user_detail')->get();
          }
        $user=User::where('id',Auth::id())->get();
        return view('organisation.index', compact('organisations'));

    }
    public function create()
    {
        $timezone_list =Timezonelist::create('current_date_utc_format', null, 'id="timezone" class="form-control select2"');

        //print_r($timezone_list);exit;
        $countries=CountryListFacade::getList('en');
        $currency=['USD','EUR','JPY','GBP','CHF','CAD','AUD','ZAR'];


        $organisationType=$this->organizationTypes();
        $busType=$this->businessTypes();

        return view('organisation/create',['organisationType'=>$organisationType,'busType'=>$busType,'countries'=>$countries,'timezone_list'=>$timezone_list,'currency'=>$currency]);
    }
    public function org_connection($databaseName)
    {
        Config::set("database.connections.mysql", [
            'driver' => 'mysql',
            "host" => "127.0.0.1",
            "database" => $databaseName,
            "username" => getenv('DB_USERNAME'),
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
                $inputs = $request->all();
                $inputs['superadmin_id']=Auth::id();
                $inputs['org_name']=$org_name;
                $file=$request->file('logo');
                $imageName='';
                $path=public_path('organisation_logo/');
                if($file!="")
                {
                  $imageName = Str::random(15).'.'.$file->getClientOriginalExtension();
                  $file->move($path, $imageName);
                }

                $org_input=[
                            'org_db_name' => str_replace(' ', '', $org_name),
                            'superadmin_id' => Auth::id(),
                            'org_name'=>$org_name,
                            'logo'=>$imageName
                        ];

                if($data=MasterOrganisation::create($org_input))
                    {
                        $inputs['org_id']=$data->id;
                        $inputs['logo']=$imageName ;
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
            $currency=['USD','EUR','JPY','GBP','CHF','CAD','AUD','ZAR'];
            $orgData=MasterOrganisation::where('id','=',$org_id)->get();
            $databaseName=$org_id.'_'.$orgData[0]->org_db_name;
            $countries=CountryListFacade::getList('en');
            $organisationType=$this->organizationTypes();
            $busType=$this->businessTypes();
            $connection=$this->org_connection($databaseName);
            $orgInfo=Organisation::where('org_id','=',$org_id)->get();
            return view('organisation/create',['organisation_data'=>$orgInfo,'organisationType'=>$organisationType,'busType'=>$busType,'countries'=>$countries,'currency'=>$currency]);

        }catch (Exception $e) {
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$e->getMessage()]);

        } catch(\Illuminate\Database\QueryException $ex){
            print_r($ex->getMessage());
            DB::rollback();
        // return response()->json(['status'=>'failed','msg'=>$ex->getMessage()]);

        }

    }
    public function view($org_id)
    {
      try{
          $orgData=MasterOrganisation::where('id','=',$org_id)->get();
          $databaseName=$org_id.'_'.$orgData[0]->org_db_name;
          $connection=$this->org_connection($databaseName);
          $orgInfo=Organisation::where('org_id','=',$org_id)->get();
          $invite_user=User::count();
          $this->updateUsedorg($org_id);

          return view('organisation/view',['organisation_data'=>$orgInfo,'invite_user'=>$invite_user]);

      }catch (Exception $e) {
          DB::rollback();

      } catch(\Illuminate\Database\QueryException $ex){
          print_r($ex->getMessage());
          DB::rollback();

      }
    }
    public function updateUsedorg($org_id)
    {
      $db=getenv("DB_DATABASE");
      $this->org_connection($db);
      $user_id=Auth::id();
      User::where('id',$user_id)->update(['used_org'=>$org_id]);
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
            $inputs=$request->all();
            $organisation=Organisation::where('id',$org_id)->get();
            $org_logo=$organisation[0]->logo;
            $file=$request->file('logo');

            if($file!="")
            {
              $path=public_path('organisation_logo/');
              $imageName = Str::random(15).'.'.$file->getClientOriginalExtension();
              $file->move($path, $imageName);
              $inputs['logo']=$imageName;
            }
            else {
              $inputs['logo']=$org_logo;
            }


            if(Organisation::where('id', $org_id)->update(Arr::except($inputs, ['_token','org_id'])))
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

        public function security($org_id)
        {
          $org_id=$org_id;
          $databaseName=$this->get_db_name($org_id);
          $connection=$this->org_connection($databaseName);
          $data=Org_setting::select('security_pin')->get();

          return view('organisation/security',['org_id'=>$org_id,'org_data'=>$data]);
        }
        public function securityUpdate(Request $request)
        {
          try{

            $databaseName=$this->get_db_name($request->org_id);
            $connection=$this->org_connection($databaseName);
            $data=Org_setting::get()->toArray();
            if(empty($data))
            {
              Org_setting::create(Arr::except($request->all(), ['_token','org_id','id']));
            }
            else {
                Org_setting::where('id', $data[0]['id'])->update(Arr::except($request->all(), ['_token','org_id','id']));
              }
              return redirect()->back()->with('success','Security token updated successfully');
            }catch( \Exception $e ){
                return redirect()->back()->with('error',$e->getMessage());

            }
          }



}
