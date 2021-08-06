<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Controllers\OrganizationController;

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
}
