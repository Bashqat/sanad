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
use App\Models\Employee;
use App\Models\Org_setting;
<<<<<<< HEAD
use App\Models\Contactattachment;
use App\Models\Contactfiles;
use App\Models\Notes;
use Str;
=======
>>>>>>> d882ca495bd2036a10f8786f6d85f0597b277193


class ContactController extends Controller
{
    //public $databaseName;
    public function __construct()
    {
        // $obj=new OrganizationController();
        // $this->databaseName=$obj->org_connection($org_db_name);
    }
    public function index(Request $request,$org_id,$type='')
    {

      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Contact::select('id','name','email','phone',)->with('contact_information')->where('type','!=','archive')->get();
      $groups=Group::with('subgroup')->get();
    //  echo '<pre>';
      //print_r($groups);exit;


      return view('contact.index',['org_id'=>$org_id,'contacts'=>$contacts,'groups'=>$groups,'type'=>$type]);
    }
    /* Function for load employe list*/
    public function employee(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Employee::select('id','name','email','phone',)->where('type','!=','archive')->get();
      $groups=Group::with('subgroup')->get();
      return view('contact.employee',['org_id'=>$org_id,'contacts'=>$contacts,'groups'=>$groups,'type'=>'employee']);
    }
    /*function for load all contacts*/
    public function serverSide(Request $request,$org_id,$type='')
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Contact::where('type','!=','archive')->with('contact_information');
      if($type!="")
      {
        $contacts=Contact::where('type','!=','archive')->where('company_type',$type)->with('contact_information');
      }
      if(request()->ajax()){
<<<<<<< HEAD
          $search=$request->search['value'];
          if($search=="country")
=======
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
        $data[$key][]='<div class="contact-name-col"><a class="text-right d-block" href="/organisation/'.$org_id.'/contact/'.$contact->id.'/view">'.$contact->name.'</a>
        <p class="text-right">'.$contact->name_arabic.'</p></div>';

        if(isset($contact->contact_information) && count($contact->contact_information)>0 )
        {
           $first_person=$contact->contact_information[0]->first_name;
           $data[$key][]='<div class="contact-list-person d-flex align-items-center"><p>'.$first_person.'</p><img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg"></div>';
         }
        else {
          $data[$key][]='';
        }
        if(isset($contact->contact_information) && count($contact->contact_information)>1 )
        {
           $second_person=$contact->contact_information[1]->first_name;
           $data[$key][]='<div class="contact-list-person d-flex align-items-center"><p>'.$second_person.'</p><img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg"></div>';

        }
        else {
          $data[$key][]='';
        }

        $data[$key][]=(isset($contact->address[0]['country'])?$contact->address[0]['country']:'');
        //$data[$key][]=$contact->email;

        $phone='';
        $token = csrf_token();

        if($contact->contact_type=='person')
        {
          if(!empty($contact->phone))
>>>>>>> d882ca495bd2036a10f8786f6d85f0597b277193
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
              $data[$key][]='<div class="contact-name-col"><a class="text-right d-block" href="/organisation/'.$org_id.'/contact/'.$contact->id.'/view">'.$contact->name.'</a>
              <p class="text-right">'.$contact->name_arabic.'</p></div>';
            if(isset($contact->contact_information) && count($contact->contact_information)>0 )
              {
                 $first_person=$contact->contact_information[0]->first_name;
                 $data[$key][]='<div class="contact-list-person d-flex align-items-center"><p>'.$first_person.'</p><img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg"></div>';
               }
            else {
              $data[$key][]='';
            }
            if(isset($contact->contact_information) && count($contact->contact_information)>1 )
            {
               $second_person=$contact->contact_information[1]->first_name;
               $data[$key][]='<div class="contact-list-person d-flex align-items-center"><p>'.$second_person.'</p><img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg"></div>';

            }
            else {
              $data[$key][]='';
            }
            $data[$key][]=(isset($contact->address[0]['country'])?$contact->address[0]['country']:'');
            $phone='';
            $token = csrf_token();

            if($contact->contact_type=='person')
            {
              if(!empty($contact->phone))
              {
                foreach($contact->phone as $phone)
                {
                  $phone=$phone['number'];
                }
              }
            }

            $edit_path=route('contacts.edit',[$org_id,$contact->id]);
            $delete_path=route('contact.delete');
            //$data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>'.$phone;
            $tags=$contact->tags;
            $tag_html='';
            if(!empty($tags))
            {
              foreach($tags as $tag )
              {
                $tag_html.='<div class="tab-buttons">
                <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">'.$tag.'</button>
                </div>';
              }
            }
            $attachment_count=(isset($contact->attachment) && !empty($contact->attachment))?count($contact->attachment):'';
            $data[$key][]=$tag_html;
            $data[$key][]='<a class="attachment-view-btn d-flex align-items-center" data-files='.json_encode($contact->attachment).' data-toggle="modal" data-target="#attachment-view" data-file-type="contact" data-id="'.$contact->id.'"><img src="/images/site-images/doc-attch.svg">'.$attachment_count.'
                    </a>';
            $data[$key][]='<div class="dropdown">
                  <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/images/site-images/3-dots-contact-list.svg" style="width:100%"></a>
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
    public function employeeServerSide(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contacts=Employee::where('type','!=','archive');
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
          $contacts=$contacts->where('name', 'like', '%' . $search . '%');
             // ->orWhere('country', 'like', '%' . $search. '%');
        }


      }
      $contacts=$contacts->get();
      $totalData=$contacts->count();
      $totalFiltered = $totalData;


      $data=[];

      foreach($contacts as $key=>$contact)
      {
        $data[$key][]='<input type="checkbox" class="row-select" value="'.$contact->id.'">';
        $data[$key][]='<a href="/organisation/'.$org_id.'/contact/'.$contact->id.'/view">'.$contact->name.'</a>
        <p>'.$contact->name_arabic.'</p>';




        //$data[$key][]=$contact->country;
        //$data[$key][]=$contact->email;

        $phone='';
        $token = csrf_token();
        $data[$key][]=(isset($contact->personal_info[0]['nationality'])?$contact->personal_info[0]['nationality']:'');



        $edit_path=route('contact.employee.edit',[$org_id,$contact->id]);
        $delete_path=route('contact.delete');
        //$data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>'.$phone;
        $data[$key][]=$contact->tags;
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

        $data[$key][]='<a href="/organisation/'.$org_id.'/contact/'.$contact->id.'/view">'.$contact->name.'</a>
        <p>'.$contact->name_arabic.'</p>';

        if(isset($contact->contact_information) && count($contact->contact_information)>0 )
        {
           $first_person=$contact->contact_information[0]->first_name;
           $data[$key][]=$first_person.'<img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg">';
         }
        else {
          $data[$key][]='';
        }
        if(isset($contact->contact_information) && count($contact->contact_information)>1 )
        {
           $second_person=$contact->contact_information[1]->first_name;
           $data[$key][]=$second_person.'<img src="/images/site-images/contact-email-data.svg"><img src="/images/site-images/contact-phone-data.svg"><img src="/images/site-images/contact-wtap-data.svg">';

        }
        else {
          $data[$key][]='';
        }

        $data[$key][]=(isset($contact->address[0]['country'])?$contact->address[0]['country']:'');
        //$data[$key][]=$contact->email;

        $phone='';
        $token = csrf_token();



        $restore_path=route('contact.restore');
        //$data[$key][]='<i class="fas fa-phone-alt mr-1" aria-hidden="true"></i>';
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
        $contact = "";
        $contactInformation = [];
        $website_information = [];

        try {
            $contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');
            $contactData['organization_id'] = $org_id;
            $contactData['created_by'] = Auth::user()->id;
            $contactData['contact_type'] = $request->input('contact_type');
            $contactData['company_type'] = $request->input('company_type');
            if(isset($contactData['first_name']) && isset($contactData['last_name']))
            {
              $contactData['name'] = $contactData['first_name'].' '.$contactData['last_name'];
              $contactData['name_arabic'] = $contactData['first_name_arabic'].' '.$contactData['last_name_arabic'];
              $contactData=Arr::except($contactData, ['_token','org_id','first_name','last_name','first_name_arabic','last_name_arabic']);
            }


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
        $contact = "";
        $contactInformation = [];
        $website_information = [];
        try {
            // Save Conatct
            //$contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');


            $contactData = $request->input('contact');
            $websiteData = $request->input('website_information');
            if($request->input('contact_type')=='person')
            {
              $contactData['name']=$contactData['first_name'].' '.$contactData['last_name'];
              $contactData['name_arabic']=$contactData['first_name_arabic'].' '.$contactData['last_name_arabic'];
              $contactData=Arr::except($contactData, ['_token','org_id','first_name','last_name','first_name_arabic','last_name_arabic']);
            }


          ///  print_r($websiteData);exit;
            //$contactData['created_by'] = Auth::user()->id;

            $contact_id=$request->input('id');
            $contact = Contact::where('id',$contact_id)->update($contactData);
            if(isset($request->website_information)){
              Websiteinformation::where('contact_id',$contact_id)->delete();

                foreach ($request->website_information as $key => $websiteData) {
                    $websiteData['contact_id'] = $contact_id;
                    $website_information[] = Websiteinformation::create($websiteData);
                }
            }
            // if(isset($request->persons_contacts)){
            //   ContactInformation::where('contact_id',$contact_id)->delete();
            //     foreach ($request->persons_contacts as $key => $data) {
            //         $contactInformationData = $this->uploadDataAttachmentsGetLinks($data,'contacts');
            //          $contactInformationData['contact_id'] = $contact->id;
            //          $contactInformation[] = ContactInformation::create($contactInformationData);
            //     }
            //   }

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
          print_r($e);exit;
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
    /* Function or load employe edit page*/
    public function employeeEdit($org_id,$contact_id)
    {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        $contact=Employee::where('id',$contact_id)->get();
        $countries = CountryListFacade::getList('en');
        return view('contact.create', compact('countries','contact','org_id'));
    }

    public function employeeStore(Request $request,$org_id)
    {
      try{
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        $request->request->add(['contacts' => $request->contact]);
        $request->request->remove('contact');
        $contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');

        // $contactData['contact']=$request->input('contacts');
         $contactData['organization_id'] = $org_id;
        $contactData['created_by'] = Auth::user()->id;
        $contactData['name'] = $contactData['first_name'].' '.$contactData['last_name'];
        $contactData['name_arabic'] =$contactData['first_name_arabic'].' '.$contactData['last_name_arabic'];
        //$contactData['contact_type'] = $request->input('contact_type');
        Employee::create($contactData);
        return redirect()->route('contact.employee',[$org_id])->with('success','Contact updated successfully.');
        // echo '<pre>';
        // print_r($contactData);exit;
      }catch (Exception $e) {
      DB::rollback();

  } catch(\Illuminate\Database\QueryException $ex){
      print_r($ex->getMessage());
      DB::rollback();


  }



    }
    public function employeeUpdate(Request $request)
    {

      try{
        $obj=new OrganizationController();
        $org_id=$request->input('org_id');
        $contact_id=$request->input('id');
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        $request->request->add(['contacts' => $request->contact]);
        $request->request->remove('contact');
        $contactData = $this->uploadDataAttachmentsGetLinks($request->contacts,'contacts');

        // $contactData['contact']=$request->input('contacts');
         $contactData['organization_id'] = $org_id;
        $contactData['created_by'] = Auth::user()->id;
        $contactData['name'] = $contactData['first_name'].' '.$contactData['last_name'];
        $contactData['name_arabic'] =$contactData['first_name_arabic'].' '.$contactData['last_name_arabic'];
        $contactData['contact_type'] = $request->input('contact_type');
        $contactData=Arr::except($contactData, ['_token','org_id','first_name','last_name','first_name_arabic','last_name_arabic']);

        Employee::where('id',$contact_id)->update($contactData);
        return redirect()->route('contact.employee',[$org_id])->with('success','Contact updated successfully.');
        // echo '<pre>';
        // print_r($contactData);exit;
      }catch (Exception $e) {
      DB::rollback();

  } catch(\Illuminate\Database\QueryException $ex){
      print_r($ex->getMessage());
      DB::rollback();

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
/* Function for load archive data*/
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
          $contact_id = $request->rows;
          $groupData=Contact::select('group_id')->where('id',$contact_id)->get()->toArray();
          $group=$groupData[0]['group_id'];

          $groupId = $request->groupId;
          if(is_array($group) && !in_array($groupId,$group))
          {
            $group[]=$groupId;
          }
          else {
            $group[]=$groupId;
          }

          // echo '<pre>';
          // print_r($group);exit;
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
<<<<<<< HEAD
                    Contact::whereIn('id', $rows)->update(['group_id' => $group]);
                    // contactInformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    // Websiteinformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
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
    public function groupContactDetail(Request $request,$org_id){
        try {
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
          $contact_id = $request->rows;
          $groupData=ContactInformation::select('group_id')->where('id',$contact_id)->get()->toArray();

          $group=(!empty($groupData)?$groupData[0]['group_id']:[]);
          $groupId = $request->groupId;
          if(is_array($group) && !in_array($groupId,$group))
          {
            $group[]=$groupId;
          }
          else {
            //$group[]=$groupId;
          }
          // echo '<pre>';

            if ( !empty( $groupId = $request->groupId ) && !empty($rows = $request->rows) ) {
                if ( isset($request->type) && $request->type == "person" ) {
                    //$rows = explode(',',$rows);
                    //print_R($group);exit;
                    if($request->group_contact_type=='contact')
                    {
                      Contact::where('id', $rows)->update(['group_id' => $group]);
                    }else{
                      contactInformation::where('id', $rows)->update(['group_id' => $group]);
                    }
                    $this->contactLog($rows,$type = 'publish','Add group','Group add successfully');
                      return response()->json([
                        'success' => 1,
                        'msg' => 'Person assign group successfully.'
                    ]);
                }else{
                  //print_R($rows);exit;
                    //$rows = explode(',',$rows);
                    if($request->group_contact_type=='contact')
                    {
                      Contact::where('id', $rows)->update(['group_id' => $group]);
                    }else{
                      contactInformation::where('id', $rows)->update(['group_id' => $group]);
                    }
                    $this->contactLog($rows,$type = 'publish','Add group','Group add successfully');
=======
                    Contact::whereIn('id', $rows)->update(['group_id' => $groupId]);
>>>>>>> d882ca495bd2036a10f8786f6d85f0597b277193
                    // contactInformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    // Websiteinformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
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
    public function groupContactDelete(Request $request,$org_id){
        try {
          $obj=new OrganizationController();
          $databaseName=$obj->get_db_name($org_id);
          $db_connection=$obj->org_connection($databaseName);
          $contact_id = $request->rows;
          $groupData=ContactInformation::select('group_id')->where('id',$contact_id)->get()->toArray();

          $group=(!empty($groupData)?$groupData[0]['group_id']:[]);
          $groupId = $request->groupId;
          if(is_array($group) && in_array($groupId,$group))
          {
            $group=array_diff([$groupId],$group);
          }
          else {
            //$group[]=$groupId;
          }
          // echo '<pre>';


            if ( !empty( $groupId = $request->groupId ) && !empty($rows = $request->rows) ) {
                if ( isset($request->type) && $request->type == "person" ) {
                    //$rows = explode(',',$rows);

                    //print_R($group);exit;
                    contactInformation::where('id', $rows)->update(['group_id' => $group]);
                    return response()->json([
                        'success' => 1,
                        'msg' => 'Person assign group successfully.'
                    ]);
                }else{
                  //print_R($rows);exit;
                    //$rows = explode(',',$rows);

                    contactInformation::where('id', $rows)->update(['group_id' => $group]);
                    // contactInformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    // Websiteinformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
                    return response()->json([
                        'success' => 1,
                        'msg' => 'Contact removed from group successfully.'
                    ]);
                }
            }
        }catch ( \Exception $e ) {
            return response()->json([
                'success' => 0,
                'msg' => $e->getMessage()
            ]);
        }
    }
    public function detailContactDelete($org_id,$id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);

      if(contactInformation::where('id', $id)->delete())
      {
        return response()->json([
            'success' => 1,
            'msg' => 'Contact deleted successfuly.'
        ]);
      }
      // contactInformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);
      // Websiteinformation::whereIn('contact_id', $rows)->update(['group_id' => $groupId]);

    }
    public function view($org_id,$contact_id)
    {
      $obj=new OrganizationController();
      $user_id=Auth::id();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contact_detail=Contact::with('contact_information')->with('notes')->with('website_information')->with('activity')->where('id',$contact_id)->get()->toArray();
      // echo '<pre>';
      // print_R($contact_detail);
      $contacts=Contact::select('id','name','email','phone',)->with('contact_information')->where('type','!=','archive')->get();

      $groups=Group::with('subgroup')->get();
      $contactGroup=[];
      $group_id=$contact_detail[0]['group_id'];
      if(!empty($group_id))
      {
        $contactGroup=Group::with('subgroup')->whereIn('id', $group_id)->get()->toArray();
      }



      return view('contact/view',compact('contact_detail','org_id','groups','contactGroup','contacts','user_id'));
    }
    public function addWebsite(Request $request)
    {
      try{

        $org_id=$request->input('org_id');
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        Websiteinformation::create($request->all());
        //return redirect()->back()->with('success','Website add successfuly');
        return response()->json(['success'=>1,'msg'=>'Website add successfuly']);

      }catch (Exception $e) {
              DB::rollback();
              return redirect()->back()->with('error',$e->getMessage());
      } catch(\Illuminate\Database\QueryException $ex){
              return redirect()->back()->with('error',$ex->getMessage());
              DB::rollback();
      }
    }

    public function viewWebsitePin(Request $request){
      $org_id=$request->input('org_id');
      $website_id=$request->input('website_id');
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $pin=$request->input('pincode');
      $pinData=Org_setting::where('security_pin',$pin)->get()->toArray();
      if(!empty($pinData))
      {
        $websiteData=Websiteinformation::where('id',$website_id)->get()->toArray();
        $password=$websiteData[0]['password'];
        return response()->json([
                      'success' => 1,
                      'msg' => "Pin match successfully",
                      'data' => $password,
                      'id' => $website_id
                  ]);

      }
      return response()->json([
                    'success' => 0,
                    'msg' => "Pin not match successfully",
                    'id' => $website_id
                ]);


    }
    public function archiveWebsite($org_id,$id)
    {

      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      if(Websiteinformation::where('id',$id)->update(['type'=>'archive']))
      {
        return redirect()->back()->with('success','Website archive successfuly');
      }

    }
    public function deleteWebsite($org_id,$id)
    {

      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      if(Websiteinformation::where('id',$id)->delete())
      {
        return redirect()->back()->with('success','Website deleted successfuly');
      }

    }
    public function archiveContactId($org_id,$id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      if(Contact::where('id',$id)->update(['type'=>'archive']))
      {
        return redirect()->back()->with('success','Contact archived successfuly');
      }
    }
    /*******  File attachment Section ******/
    public function contactAttachmentUpload(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
<<<<<<< HEAD
=======
      $contact_detail=Contact::with('contact_information')->with('website_information')->where('id',$contact_id)->get()->toArray();
      $groups=Group::with('subgroup')->get();


      return view('contact/view',compact('contact_detail','org_id','groups'));
    }
    public function addWebsite(Request $request)
    {
      try{
        $org_id=$request->input('org_id');
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        Websiteinformation::create($request->all());
        return redirect()->back()->with('success','Website add successfuly');

      }catch (Exception $e) {
              DB::rollback();
              return redirect()->back()->with('error',$e->getMessage());
      } catch(\Illuminate\Database\QueryException $ex){
              return redirect()->back()->with('error',$ex->getMessage());
              DB::rollback();
      }
    }

    public function viewWebsitePin(Request $request){
      $org_id=$request->input('org_id');
      $website_id=$request->input('website_id');
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $pin=$request->input('pincode');
      $pinData=Org_setting::where('security_pin',$pin)->get()->toArray();
      if(!empty($pinData))
      {
        $websiteData=Websiteinformation::where('id',$website_id)->get()->toArray();
        $password=$websiteData[0]['password'];
        return response()->json([
                      'success' => 1,
                      'msg' => "Pin match successfully",
                      'data' => $password,
                      'id' => $website_id
                  ]);

      }
      return response()->json([
                    'success' => 0,
                    'msg' => "Pin not match successfully",
                    'id' => $website_id
                ]);
>>>>>>> d882ca495bd2036a10f8786f6d85f0597b277193

        try {
            if (!empty($request->files)) {
                $data = $this->uploadDataAttachmentsGetLinks($request->all(),'contacts');
                if ($request->uploadType == 'contact') {
                    $modal = new Contact;
                  }
                // }elseif ($request->uploadType == 'contactInformation') {
                //     $modal = new contactInformation;
                // }elseif ($request->uploadType == 'note') {
                //     $modal = new contactNotes;
                // }
                $oldAttachments = $modal->select('attachment')->where('id',$request->id)->first();
                if (empty($oldAttachments->attachment)) {
                    $modal->where('id', $request->id)->update(['attachment'=> $data['files']]);
                }else{
                    $finalData = array_merge( $oldAttachments->attachment, $data['files'] );
                    $modal->where('id', $request->id)->update(['attachment'=> $finalData]);
                }
                return redirect()->back()->with('success',"File upload successfully.");
            }else{
                return redirect()->back()->with('error',"No file selected.");
            }
        }catch ( \Exception $e ) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

<<<<<<< HEAD
    public function addnewFolder(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      try {
          Contactattachment::create($request->all());
          return redirect()->back()->with('success','folder created successfuly');
      }catch ( \Exception $e ) {
          return redirect()->back()->with('error',$e->getMessage());
      }
    }
    public function listFolder(Request $request,$org_id)
    {

      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contact_id=$request->input('data_id');
      $contact_detail_id=$request->input('data_contact_id');
      $folderList=Contactattachment::where('contact_id',$contact_id)->where('contact_detail_id',$contact_detail_id)->get()->toArray();
      $files=[];
      if(!empty($folderList))
      {
        foreach($folderList as $key=>$list)
        {
          $files[$list['id']]=Contactfiles::where('folder_id',$list['id'])->limit('5')->get()->toArray();
          $count =Contactfiles::where('folder_id',$list['id'])->count();
          $pages = ceil($count/5);
          //$files[$key]['files']=Contactfiles::where('folder_id',$list['id'])->get()->toArray();
        }

      }
      return view('contact/attachment',compact('folderList','files','contact_detail_id','contact_id','org_id'));
    }
    public function storeFile(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $file_name=$request->file('file_name');
      $path=public_path('contact-attachment/');
      if($file_name!="")
      {
        $imageName = Str::random(15).'.'.$file_name->getClientOriginalExtension();
        $file_path='/contact-attachment'.'/'.$imageName;
        $file_name->move($path, $imageName);
        $attachment['folder_id']=$request->input('folder_id');
        $attachment['file_type']=$file_name->getClientOriginalExtension();
        $attachment['file_path']=$file_path;
        $attachment['file_name']=$file_name->getClientOriginalName();
        if(Contactfiles::create($attachment))
        {
          $contactfile=Contactfiles::all()->last();
          $date=$contactfile->created_at;
          $file_id=$contactfile->id;
          $file_type=$contactfile->file_type;


          $created_at = date('d/m/Y ', strtotime($date));
          $created_at_time = date("h:i:sa", strtotime($date));
          $html='<div class="tab-files-detail d-flex justify-content-between align-items-center">
              <div class="attached-file">
                  <img src="/images/site-images/attached-pdf.svg">
              </div>
              <div class="attached-file-name">
                  <p class="file_name_'.$file_id.'">'.$file_name->getClientOriginalName().'</p>
                  <span>File Uploaded on - '.$created_at.' - '.$created_at_time.' </span>
              </div>
              <div class="attached-file-options">
                  <div class="dropdown">
                      <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="/images/site-images/3-dots-attach-option.svg">
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item file_rename" file_id="'.$file_id.'" file_type="'.$file_type.'"  href="#">Rename</a>
                          <a class="dropdown-item" href="'.$file_path.'" target="_blank" download="'.$file_name->getClientOriginalName().'">Download</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                  </div>
              </div>
          </div>';
          return $html;
        }
      }

    }
    public function renameFolder(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $folder_name=$request->input('folder_name');
      $folder_id=$request->input('folder_id');
      if(Contactattachment::where('id',$folder_id)->update(['folder_name'=>$folder_name]))
      {
        return $folder_name;
      }
      else {
        return 'error';
      }

    }
    public function renameFile(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);

      $file_name=$request->input('file_name').'.'.$request->input('file_type');
      $file_id=$request->input('file_id');
      if(Contactfiles::where('id',$file_id)->update(['file_name'=>$file_name]))
      {
        //return $file_name;
        return response()->json(['file_name'=>$file_name,'file_id'=>$file_id,'status'=>'success']);
      }
      else {
        return response()->json(['status'=>'error']);
      }

    }
    public function folderList(Request $request,$org_id,$id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $contact_id=$id;
      $folderlist=Contactattachment::where('contact_detail_id',$contact_id)->get()->toArray();

      return response()->json($folderlist);
    }
    public function fileMove(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);


      $file_id=$request->input('file_id');
      $folder_id=$request->input('folder_name');
      if(Contactfiles::where('id',$file_id)->update(['folder_id'=>$folder_id]))
      {
        //return $file_name;
        return response()->json(['file_id'=>$file_id,'status'=>'success']);
      }
      else {
        return response()->json(['status'=>'error']);
      }
    }
    public function deleteFolder(Request $request,$org_id,$id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $filelist=Contactfiles::where('folder_id',$id)->get()->toArray();


      if(empty($filelist))
      {
        //return $file_name;
        Contactattachment::where('id',$id)->delete();
        return response()->json(['folder_id'=>$id,'status'=>'success']);
      }
      else {
        return response()->json(['status'=>'error']);
      }
    }
    public function filePagination($org_id,$folder_id,$pageno)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      $skip=$pageno*5-5;
      $take=$pageno*5-5;
      if($pageno==1){
        $skip=0;
        $take=5;
      }
      //$filelist=Contactfiles::where('folder_id',$id)->get()->toArray();
      //$files[$list['id']]=Contactfiles::where('folder_id',$folder_id)->limit('5')->get()->toArray();
      $count =Contactfiles::where('folder_id',$folder_id)->count();
      //$pages = ceil($count/5);
      $filelist=Contactfiles::where('folder_id',$folder_id)->skip($skip)->take($take)->get()->toArray();
      $contact_detail_id=Contactattachment::select('contact_detail_id')->where('id',$folder_id)->get()->toArray();
      $html='';
      foreach($filelist as $file)
      {
        $created_at = date('d/m/Y ', strtotime($file['created_at']));
        $created_at_time = date("h:i:sa", strtotime($file['created_at']));
        $html.='<div class="tab-files-detail file_detail_'.$file['id'].' d-flex justify-content-between align-items-center">
            <div class="attached-file">
                <img src="/images/site-images/attached-pdf.svg">
            </div>
            <div class="attached-file-name">
                <p class="file_name_'.$file['id'].'">'.$file['file_name'].'</p>
                <span>File Uploaded on - '.$created_at.'-'.$created_at_time.' </span>
            </div>
            <div class="attached-file-options">
                <div class="dropdown">
                    <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/images/site-images/3-dots-attach-option.svg">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item file_rename" file_id="'.$file['id'].'" file_type="'.$file['file_type'].'"  href="#">Rename</a>
                        <a class="dropdown-item" href="'.$file['file_path'].'" target="_blank" download="'.$file['file_name'].'">Download</a>
                        <a class="dropdown-item move_file" file_id="'.$file['id'].'" contact_id="'.$contact_detail_id[0]['contact_detail_id'].'" href="#">Move file to other folder</a>
                    </div>
                </div>
            </div>
        </div>';
      }
      return $html;

    }
    public function addNote(Request $request,$org_id)
    {
      $obj=new OrganizationController();
      $databaseName=$obj->get_db_name($org_id);
      $db_connection=$obj->org_connection($databaseName);
      // $notes['content_id']=$request->input('content_id');
      // $notes['file_type']=$file_name->getClientOriginalExtension();
      // $notes['file_path']=$file_path;
      // $notes['file_name']=$file_name->getClientOriginalName();
      $notes=$request->all();
      if(Notes::create($notes))
      {
        $notes=Notes::all()->last();
        $created_at = date('d/m/Y ', strtotime($notes->created_at));
        $created_at_time = date("h:i:sa", strtotime($notes->created_at));
            $html='<tr>
                    <td><input type="checkbox" class="" value=""></td>
                    <td><span>'.$notes->header.'</span>
                    <p>'.$notes->content.'</p>
                    <div class="notes-time-detail d-flex">
                        <span>By Keith Willaim </span>
                        <p>(Last edited by - Mark Boucher - '.$created_at.' - '.$created_at_time.')</p>
                    </div>
                  </td>
              <td>
                  <div class="nots-attach-pdf d-flex align-items-center">
                      <img src="/images/site-images/c-p-l-pdf.svg">(03)
                      <img src="/images/site-images/contact-nots-pin.svg">
                  </div>
              </td>
        </tr>';
        return $html;
      }
=======
>>>>>>> d882ca495bd2036a10f8786f6d85f0597b277193
    }
}
