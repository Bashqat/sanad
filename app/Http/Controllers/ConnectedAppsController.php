<?php

namespace App\Http\Controllers;

use App\Models\ConnectedApps;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\OrganizationController;

class ConnectedAppsController extends Controller
{
    protected $id,$userData;
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware(function ($request, $next) {
          $this->id = Auth::id();
          $this->userData=User::where('id',$this->id)->get();
          $this->role=$this->userData[0]->role;
          return $next($request);
      });
    }

    public function create($org_id,$app_id="")
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $connection=$obj->org_connection($databaseName);
      $apps=[];
      if($app_id!="")
      {
        $apps = ConnectedApps::where('id',$app_id)->get()->toArray();
      }

      return view('connected-apps/create',compact('apps','org_id'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($org_id)
    {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $connection=$obj->org_connection($databaseName);
        $apps = ConnectedApps::all();
        return view('connected-apps.index', compact('apps','org_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
          $org_id=$request->input('org_id');
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $connection=$obj->org_connection($databaseName);
          $data=$request->all();
          ConnectedApps::create(Arr::except($data, ['_token','org_id']));
          return redirect()->route('organisation.app',$org_id)->with('success','App created successfully.');
    }catch( \Exception $e ){
        return redirect()->back()->with('error',$e->getMessage());

    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ConnectedApps  $connectedApps
     * @return \Illuminate\Http\Response
     */
    public function show(ConnectedApps $connectedApps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConnectedApps  $connectedApps
     * @return \Illuminate\Http\Response
     */
    public function edit(ConnectedApps $connectedApps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConnectedApps  $connectedApps
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConnectedApps $connectedApps)
    {
        try{


              $org_id=$request->input('org_id');
              $obj=new OrganizationController();
              $databaseName=$obj->get_db_name($org_id);
              $connection=$obj->org_connection($databaseName);
              $id=$request->input('id');
              $connectedApps = ConnectedApps::find($id);
              $connectedApps->update(['status' => $request->status]);
              return redirect()->route('organisation.app',$org_id);
          }catch( \Exception $e ){
              return redirect()->back()->with('error',$e->getMessage());

          }
    }
    public function updateData(Request $request, ConnectedApps $connectedApps)
    {
        try{


              $org_id=$request->input('org_id');
              $obj=new OrganizationController();
              $databaseName=$obj->get_db_name($org_id);
              $connection=$obj->org_connection($databaseName);
              $id=$request->input('id');
              $connectedApps = ConnectedApps::find($id);
              $data=$request->all();
              $connectedApps->update(Arr::except($data, ['_token','status','org_id']));
              return redirect()->route('organisation.app',$org_id);
          }catch( \Exception $e ){
              return redirect()->back()->with('error',$e->getMessage());

          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ConnectedApps  $connectedApps
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      try{


            $org_id=$request->input('org_id');
            $obj=new OrganizationController();
            $databaseName=$obj->get_db_name($org_id);
            $connection=$obj->org_connection($databaseName);
            $id=$request->input('id');
            if(ConnectedApps::where('id',$id)->delete())
            {
              return redirect()->route('organisation.app',$org_id)->with('success','App deleted successfully');
            }


        }catch( \Exception $e ){
            return redirect()->back()->with('error',$e->getMessage());

        }
    }
}
