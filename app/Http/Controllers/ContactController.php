<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;
use App\Http\Controllers\OrganizationController;
use App\Models\Contact;
use App\Models\ContactInformation;
use App\Models\Websiteinformation;
use App\Models\contact_activity;
use Auth;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Group;


class ContactController extends Controller
{
    //public $databaseName;
    public function __construct()
    {
        // $obj=new OrganizationController();
        // $this->databaseName=$obj->org_connection($org_db_name);
    }
    public function index(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Contact::select('name','email','phone',)->where('type','!=','archive')->get();
      $groups=Group::get();
      // if(request()->ajax()){
      //   $filter=$request->filter_value;
      //   $contacts=Contact::where('type','!=','archive')->orderBy('tags', 'DESC')->get();
      //   return view('contact.filter',['org_id'=>$org_id,'contacts'=>$contacts]);
      // }
      //return json_encode($contacts);
       return view('contact.index',['org_id'=>$org_id,'contacts'=>$contacts,'groups'=>$groups]);
    }
    public function serverSide(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);

      $contacts=Contact::where('type','!=','archive');
      if(request()->ajax()){
        $search=$request->search['value'];
        if($search=="country")
        {
          $contacts=$contacts->orderBy('country', 'ASC');
        }
        if($search=="tag")
        {
          $contacts=$contacts->orderBy('tags', 'ASC');
        }
        else if($search!="") {
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
        $data[$key][]='<input type="checkbox" class="row-select" value="'.$contact->id.'">';
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
        $edit_path=route('contact.edit',[$org_id,$contact->id]);
        $delete_path=route('contact.delete');
        $data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>'.$phone;
        $data[$key][]='<div class="dropdown">
                  <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                  <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);"><a href="'.$edit_path.'" class="dropdown-item">Edit</a>
                  <form class="inline-block" action="'.$delete_path.'" method="POST" onsubmit="return confirm(`Are you sure?`);">

                      <input type="hidden" name="org_id" value="'.$org_id.'">

                      <input type="hidden" name="id" value="'.$contact->id.'">
                      <input type="hidden" name="_token" value="'.$token.'">
                      <input type="submit" class="dropdown-item" value="Delete">
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
    public function archiveserverSide(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);

      $contacts=Contact::where('type','=','archive');
      if(request()->ajax()){
        $search=$request->search['value'];
        if($search=="country")
        {
          $contacts=$contacts->orderBy('address', 'ASC');
        }
        else if($search!="") {
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
        $data[$key][]='<input type="checkbox" class="row-select" value="'.$contact->id.'">';
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

        $restore_path=route('contact.restore');
        $data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>'.$phone;
        $data[$key][]='<div class="dropdown">
                  <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                  <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
                  <form class="inline-block" action="'.$restore_path.'" method="POST" onsubmit="return confirm(`Are you want to restore?`);">

                      <input type="hidden" name="org_id" value="'.$org_id.'">

                      <input type="hidden" name="id" value="'.$contact->id.'">
                      <input type="hidden" name="_token" value="'.$token.'">
                      <input type="submit" class="dropdown-item" value="Restore">
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
    public function create($org_id)
    {
        $countries = CountryListFacade::getList('en');
        return view('contact.create',compact('countries','org_id'));
    }
    public function store(Request $request,$org_id)
    {

        $obj=new OrganizationController();

        $databaseName=$obj->get_db_name($org_id);

        $db_connection=$obj->org_connection($databaseName);

        $request->request->add(['contacts' => $request->contact]);
        $request->request->remove('contact');

        $validate = $request->validate([
            'contacts.account_no' => 'unique:contacts|max:255|nullable',
            'contacts.name' => 'unique:contacts|required|regex:/^[\pL\s\-]+$/u|max:255',
        ],[
            'contacts.account_no.unique' => 'Account no# already exists',
            'contacts.name.unique' => 'Account name already exists',
            'contacts.name.regex' => 'The name format is invalid.',
        ]);

        $contact = "";
        $contactInformation = [];
        $website_information = [];
        try {
            // Save Conatct
            $contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');

            $contactData['organization_id'] = $org_id;
            $contactData['created_by'] = Auth::user()->id;
            $contact = Contact::create($contactData);

            // Save Conatct Information
            if(isset($request->persons_contacts)){
                foreach ($request->persons_contacts as $key => $data) {
                    $contactInformationData = $this->uploadDataAttachmentsGetLinks($data,'contacts');
                     $contactInformationData['contact_id'] = $contact->id;
                     $contactInformation[] = ContactInformation::create($contactInformationData);
                }
            }

            // Save Website Information
            if(isset($request->website_information)){
                foreach ($request->website_information as $key => $websiteData) {
                    $websiteData['contact_id'] = $contact->id;
                    $website_information[] = Websiteinformation::create($websiteData);
                }
            }

            return redirect()->route('contact.index',[$org_id])->with('success','Contact added successfully.');
        }catch ( \Exception $e ) {
            if($contact != ""){
                $contact->delete();
            }
            if(!empty($contactInformation)){
                foreach ($contactInformation as $key => $data) {
                    $data->delete();
                }
            }
            if(!empty($website_information)){
                foreach ($website_information as $key => $data) {
                    $data->delete();
                }
            }
            return redirect()->route('contact.index',[$org_id])->with('error',$e->getMessage());
        }
    }
    public function edit($org_id,$contact_id)
    {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        $contactInformation = contactInformation::where('contact_id',$contact_id)->get();
        $contact=Contact::with('contact_information')->with('website_information')->where('id',$contact_id)->get();

        //$website_information = website_information::where('contact_id',$contact_id)->get();
        $countries = CountryListFacade::getList('en');

        return view('contact.create', compact('countries','contact','org_id'));


    }
    public function update(Request $request)
    {

        $obj=new OrganizationController();
        $org_id=$request->input('org_id');
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);

      //  $request->request->add(['contacts' => $request->contact]);
        //$request->request->remove('contact');

        // $validate = $request->validate([
        //     'contacts.account_no' => 'unique:contacts|max:255|nullable',
        //     'contacts.name' => 'unique:contacts|required|regex:/^[\pL\s\-]+$/u|max:255',
        // ],[
        //     'contacts.account_no.unique' => 'Account no# already exists',
        //     'contacts.name.unique' => 'Account name already exists',
        //     'contacts.name.regex' => 'The name format is invalid.',
        // ]);

        $contact = "";
        $contactInformation = [];
        $website_information = [];
        try {
            // Save Conatct
            //$contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');

            $contactData = $request->input('contact');
            //$contactData['created_by'] = Auth::user()->id;

            $contact_id=$request->input('id');
            $contact = Contact::where('id',$contact_id)->update(Arr::except($contactData, ['_token','org_id']));

            // Save Conatct Information
            // if(isset($request->persons_contacts)){
            //     foreach ($request->persons_contacts as $key => $data) {
            //         $contactInformationData = $this->uploadDataAttachmentsGetLinks($data,'contacts');
            //          $contactInformationData['contact_id'] = $contact->id;
            //          $contactInformation[] = ContactInformation::create($contactInformationData);
            //     }
            // }

            // Save Website Information
            // if(isset($request->website_information)){
            //     foreach ($request->website_information as $key => $websiteData) {
            //         $websiteData['contact_id'] = $contact->id;
            //         $website_information[] = Websiteinformation::create($websiteData);
            //     }
            // }

            return redirect()->route('contact.index',[$org_id])->with('success','Contact updated successfully.');
        }catch ( \Exception $e ) {
            if($contact != ""){
                $contact->delete();
            }
            if(!empty($contactInformation)){
                foreach ($contactInformation as $key => $data) {
                    $data->delete();
                }
            }
            if(!empty($website_information)){
                foreach ($website_information as $key => $data) {
                    $data->delete();
                }
            }
            return redirect()->route('contact.index',[$org_id])->with('error',$e->getMessage());
        }
    }

    public function destroye(Request $request)
    {

      $obj=new OrganizationController();
      $org_id=$request->input('org_id');

      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $id=$request->input('id');
      $org_id=$request->input('org_id');
      Contact::where('id',$id)->delete();
      return redirect()->route('contact.index',[$org_id])->with('success','Contact deleted successfuly');

    }

    // Export Contacts
    public function exportContacts($org_id,$type,$id = null)
    {
        try {
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
            $exportData = [];
            $contacts = [];
            $fileName = '';
            switch ($type) {
                case 'all':
                    $contacts = Contact::all()->toArray();
                    $fileName = 'all-contacts';
                break;
                case 'archive':
                    $contacts = Contact::where('type','archive')->get()->toArray();
                    $fileName = 'archive-contacts';
                break;
                case 'group':
                    $group = Group::find($id);
                    if (!empty($group)) {
                        $contacts = Contact::where('group_id',$id)->get()->toArray();
                        $fileName = 'group-'.$group->title.'-contacts';
                    }else{
                        return redirect()->back()->with('error',"Group not found");
                    }
                break;
            }

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=".$fileName.".csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            if(!empty($contacts)){
                foreach ($contacts as $index => $contact) {
                    foreach ($contact as $key => $value) {
                        if ( is_array($value) ) {
                            $contacts[$index][$key] = json_encode( $value );
                        }
                        if ( empty($value) ) {
                            $contacts[$index][$key] = "null";
                        }
                    }
                    $info = contactInformation::where('contact_id',$contact['id'])->get()->toArray();
                    $web = Websiteinformation::where('contact_id',$contact['id'])->get()->toArray();
                    $contacts[$index]['person_information'] = json_encode($info);
                    $contacts[$index]['website_information'] = json_encode($web);
                }

                $callback = function() use ($contacts)
                {
                    $file = fopen('php://output', 'w');
                    $columns = array_keys( $contacts[0] );
                    fputcsv($file, $columns);
                    foreach($contacts as $contact) {
                        fputcsv($file, $contact);
                    }
                    fclose($file);
                };
                return \Response::stream($callback, 200, $headers);
            }else{
                return redirect()->back()->with('error',"No contacts found");
            }
        }catch ( \Exception $e ) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    // Tag Contact
    public function tagContact(Request $request){

        try {
          $obj=new OrganizationController();
          $org_id=$request->input('org_id');
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
            if ( !empty( $tag = $request->tag ) && !empty($rows = $request->rows) ) {
                $rows = explode(',',$rows);

                foreach ($rows as $key => $row) {
                    $arr = [];
                    $contact = Contact::select('tags')->where('id','=',$row)->orderBy('tags','DESC');
                    $getTags = $contact->first();


                    $arr = $getTags->tags;
                    if (!empty($arr)) {
                        if (!in_array($tag, $arr)){
                            array_push($arr,$tag);
                            $contact->update(['tags' => $arr]);
                        }else{
                            return response()->json([
                                'success' => 0,
                                'msg' => 'Contact tag already exists.'
                            ]);
                        }
                    }else{
                        Contact::where('id', $row)->update(['tags' => [$tag]]);
                    }
                }
                return response()->json([
                    'success' => 1,
                    'msg' => 'Contact tag added successfully.'
                ]);
            }else{
                return response()->json([
                    'success' => 0,
                    'msg' => 'Contact tag not empty or Row must be selected.'
                ]);
            }
        }catch ( \Exception $e ) {
            return response()->json([
                'success' => 0,
                'msg' => $e->getMessage()
            ]);
        }
    }

    public function contactToArchive(Request $request,$org_id){
        try {

              $obj=new OrganizationController();
              $databaseName=$obj->get_db_name($org_id);
              $db_connection=$obj->org_connection($databaseName);
            if( !empty($rows = $request->rows ) ){

                $contact = Contact::whereIn('id', $rows)->update(['type' => 'archive']);
                Websiteinformation::whereIn('contact_id', $rows)->update(['type' => 'archive']);
                contactInformation::whereIn('contact_id', $rows)->update(['type' => 'archive']);
                foreach ($rows as $row) {
                    $contact = Contact::find($row);

                    $this->contactLog($contact->id,'contact','archive','Contact '.$contact->name.' has been archived.');
                }

                return response()->json([
                    'success' => 1,
                    'msg' => 'Contact archive successfully.'
                ], 200);
            }
        } catch ( \Exception $e) {
            return response()->json([
                'success' => 0,
                'msg' => $e->getMessage()
            ], 500);
        }
    }
    // Create Activity Log
    public function contactLog($contactId,$type = 'publish',$title,$log)
    {
        try {
            contact_activity::create([
                'contact_id' => $contactId,
                'type' => $type,
                'title' => $title,
                'description' => $log,
                'activity_by' => auth()->user()->id
            ]);
        }catch ( \Exception $e ) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function archive($org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Contact::where('type','=','archive')->get();

      return view('contact.archive',['org_id'=>$org_id,'contacts'=>$contacts]);


  }

  // Contact Merge
  public function contactToMerge(Request $request,$org_id){


      try {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        if(request()->ajax()){
            $rows = $request->rows;
            if (empty($rows)) {
                return response()->json([
                    'success' => 0,
                    'msg' => "Contact id not found!"
                ]);
            }
            $contacts = Contact::where('type','contact')->pluck('name', 'id');

            return view('contact.merge-contact-modal', compact('contacts','rows','org_id'));
        }

          if($request->mergeContactId){
              $archive_id = $request->rows;
              $id = $request->mergeContactId;
              $status = 'archive';
              $allAddress = [];
              $mergeData=Contact::where('id',$archive_id)->get()->toArray();
              $websiteData=Websiteinformation::where('contact_id',$archive_id)->get()->toArray();
              $contactData=ContactInformation::where('contact_id',$archive_id)->get()->toArray();
              $websiteData[0]['updated_at']=date('Y-m-d h:i:s');
              $contactData[0]['updated_at']=date('Y-m-d h:i:s');
              $mergeData[0]['updated_at']=date('Y-m-d h:i:s');
              if(!empty($contactData))
              {
                ContactInformation::where('contact_id',$id)->update(['type'=>'archive']);
                ContactInformation::where('contact_id',$archive_id)->update(['type'=>'merged']);
                foreach($contactData as $contact){
                  $contact['contact_id']=$id;
                  $contact['type']='contact';
                  ContactInformation::create($contact);
                }
              }

              $mergeData[0]['updated_at']=date('Y-m-d h:i:s');
              if(!empty($websiteData))
              {
                Websiteinformation::where('contact_id',$id)->update(['type'=>'archive']);
                Websiteinformation::where('contact_id',$archive_id)->update(['type'=>'merged']);
                foreach($websiteData as $website){
                  $website['contact_id']=$id;
                  $website['type']='contact';
                  Websiteinformation::create($website);
                }
              }



                Contact::where('id',$archive_id)->update(['type'=>'archive','merged_to'=>$id]);
                return redirect()->back()->with('success','Contact merge successfully');




          }else{
              throw new Exception("Contact must selected for merge", 500);
          }
      }catch ( \Exception $e ) {
          return redirect()->back()->with('error',$e->getMessage());
      }
    }
    public function contactToRestore(Request $request)
    {
      $obj=new OrganizationController();
      $org_id=$request->input('org_id');
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $restoreContactId=$request->input('id');
      Contact::where('id',$restoreContactId)->update(['type'=>"contact"]);
      ContactInformation::where('contact_id','=',$restoreContactId)->where('type','merged')->update(['type'=>'contact']);
      Websiteinformation::where('contact_id','=',$restoreContactId)->where('type','merged')->update(['type'=>'contact']);
      $parentContact=Contact::select('merged_to')->where('id',$restoreContactId)->get();
      $parentId=$parentContact[0]->merged_to;

      ContactInformation::where('contact_id',$parentId)->where('type','contact')->delete();
      Websiteinformation::where('contact_id',$parentId)->where('type','contact')->delete();
      ContactInformation::where('contact_id',$parentId)->where('type','archive')->update(['type'=>'contact']);
      Websiteinformation::where('contact_id',$parentId)->where('type','archive')->update(['type'=>'contact']);

      return redirect()->route('contact.archive',[$org_id])->with('success','Contact Restored successfully.');
    }
    public function groupContact(Request $request,$org_id){
        try {
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
            if ( !empty( $groupId = $request->groupId ) && !empty($rows = $request->rows) ) {
                if ( isset($request->type) && $request->type == "person" ) {
                    $rows = explode(',',$rows);
                    contactInformation::whereIn('id', $rows)->update(['group_id' => $groupId]);
                    return response()->json([
                        'success' => 1,
                        'msg' => 'Person assign group successfully.'
                    ]);
                }else{
                    $rows = explode(',',$rows);
                    Contact::whereIn('id', $rows)->update(['group_id' => $groupId]);
                    contactInformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    Websiteinformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    return response()->json([
                        'success' => 1,
                        'msg' => 'Contact moved in group successfully.'
                    ]);
                }
            }else{
                return response()->json([
                    'success' => 0,
                    'msg' => 'Group Id or Row must me selected.'
                ]);
            }
        }catch ( \Exception $e ) {
            return response()->json([
                'success' => 0,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
