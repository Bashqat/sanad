<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Controllers\OrganizationController;
use App\Models\Contact;

class GroupController extends Controller
{
    public function index(Request $request,$org_id)
    {

      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      if(request()->ajax()){

          $groups = Group::where('type', request()->type)->get();

          return datatables($groups)
          ->addColumn(
              'action',function ($row) use($org_id){

                  $html = '<div class="dropdown">
                          <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                          <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">';

                          $html .= '<a href="'.route('organisation.group.edit',[ $org_id,$row->id]).'" class="dropdown-item group-edit">Edit</a>';
                          $html .= '
                              <form class="inline-block" action="'.route('organisation.group.destroy', $row->id).'" method="POST" onsubmit="return confirm(`Are you sure?`);">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="_token" value="'.csrf_token().'">
                              <input type="submit" class="dropdown-item" value="Delete">
                          </form>';
                      $html .= '</div>
                      </div>';
                      return $html;

              }
          )
          ->addColumn('select', function ($row) {
              return  '<input type="checkbox" class="row-select" value="' . $row->id .'">' ;
          })
          ->editColumn('parent', function ($row) {
              $parent = Group::where('id',$row->parent)->first();
              return (empty($parent) ? '':$parent->title);
          })
          ->rawColumns(['action','select'])
          ->make(true);
      }
      $groupTree = Group::where('parent',NULL)->get();
      $groups = Group::all();
      return view('group.index',compact('groups','groupTree','org_id'));
    }
    public function store(Request $request)
    {

        $obj=new OrganizationController();
        $org_id=$request->input('org_id');
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        Group::create($request->validate([
            'title' => 'required|unique:groups|max:255',
            'parent' => 'max:255',
        ]));
        return redirect()->back()->with('success','Group Added successfully.');
    }
    public function edit(Group $group,$org_id)
    {
        if (request()->ajax()) {
            $groups = Group::all();
            $prentClass = (!$group->parent)?'color-change':'';
            $html = '<form method="POST" action="'.route('group.update',[$group->id]).' }}">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Group</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body add-gp-sec">
                            <div class="form-group">
                                <label for="group-name" class="col-form-label">Group Name:</label>
                                <input type="text" name="title" class="form-control" id="group-name" value="'.$group->title.'">
                            </div>
                            <div class="form-group">
                                <label for="group-parent" class="col-form-label">Select Parent:</label>
                                <select id="group-parent" name="parent" class="form-control select2bs4 select2 select-input-field '.$prentClass.'" style="width: 100%;">
                                    <option value="">Select Group Parent</option>';
                                    foreach ($groups as $listgroup) {
                                        $selected = ($listgroup->id == $group->parent) ? "selected":"";
                                        $html .= '<option value="'.$listgroup->id.'" '.$selected.'>'. $listgroup->title.'</option>';
                                    }
                        $html .= '</select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>';
            return response()->json([
                'success' => 1,
                'msg' => $html
            ], 200);
        }
    }
    public function contactList($org_id,$group_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $group[]=$group_id;

      $contacts=Contact::where('type','!=','archive')->whereIn('group_id',[1,2])->get();
      echo '<pre>';
      print_r($contacts);exit;
      $groups=Group::get();
      // if(request()->ajax()){
      //   $filter=$request->filter_value;
      //   $contacts=Contact::where('type','!=','archive')->orderBy('tags', 'DESC')->get();
      //   return view('contact.filter',['org_id'=>$org_id,'contacts'=>$contacts]);
      // }
      //return json_encode($contacts);
       return view('contact.index',['org_id'=>$org_id,'contacts'=>$contacts,'groups'=>$groups,'group_id'=>$group_id]);

    }
    public function contactserverSide(Request $request,$org_id,$group_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);

      $contacts=Contact::where('type','!=','archive')->where('group_id',$group_id);
      if(request()->ajax()){
        $search=$request->search['value'];

        if($search!="") {
          $contacts=$contacts->where('name', 'like', '%' . $search . '%')
             ->orWhere('website', 'like', '%' . $search. '%');
        }


      }
      $contacts=$contacts->get();
      $totalData=$contacts->count();
      $totalFiltered = $totalData;
      $data=[];
      foreach($contacts as $key=>$contact)
      {
        //$data[$key][]='<input type="checkbox" class="row-select" value="'.$contact->id.'">';
        $data[$key][]=$contact->name;
        $data[$key][]=$contact->website;
        $data[$key][]=$contact->email;
        $phone='';
        $token = csrf_token();

        if(!empty($contact->phone))
        {
          foreach($contact->phone as $phone)
          {
            $phone=$phone;
          }
        }
        $group_remove_path=route('group.contact.remove');
        $data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>'.$phone;
        $data[$key][]='<div class="dropdown">
                  <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                  <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
                  <form class="inline-block" action="'.$group_remove_path.'" method="POST" onsubmit="return confirm(`Are you sure?`);">

                      <input type="hidden" name="org_id" value="'.$org_id.'">

                      <input type="hidden" name="contact_id" value="'.$contact->id.'">
                      <input type="hidden" name="group_id" value="'.$group_id.'">
                      <input type="hidden" name="_token" value="'.$token.'">
                      <input type="submit" class="dropdown-item" value="Remove">
                  </form>
              </div>
            </div>';
      }


          //$tabledata[]=$data;
      $json_data = [
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
              ];
      echo  json_encode($json_data);

    }
    public function groupRemove(Request $request)
    {
      try{
          $contact_id=$request->input('contact_id');
          $group_id=$request->input('group_id');
          $org_id=$request->input('org_id');
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
          Contact::where('id',$contact_id)->where('group_id',$group_id)->update(['group_id'=>'0']);
          return redirect()->back()->with('success','Contact removed successfully.');

        }catch (Exception $e) {
        DB::rollback();
        } catch(\Illuminate\Database\QueryException $ex){
        print_r($ex->getMessage());
        DB::rollback();


    }
    }

}
