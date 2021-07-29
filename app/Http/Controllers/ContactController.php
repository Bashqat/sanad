<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;
use App\Http\Controllers\OrganizationController;
use App\Models\Contact;
use App\Models\ContactInformation;
use App\Models\Websiteinformation;
use Auth;
use Illuminate\Support\Arr;

class ContactController extends Controller
{
    //public $databaseName;
    public function __construct()
    {
        // $obj=new OrganizationController();
        // $this->databaseName=$obj->org_connection($org_db_name);
    }
    public function index($org_id)
    {
        $obj=new OrganizationController();
        $databaseName=$obj->get_db_name($org_id);
        $db_connection=$obj->org_connection($databaseName);
        $contacts=Contact::get();
        return view('contact.index',['org_id'=>$org_id,'contacts'=>$contacts]);
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
        $contact=Contact::where('id',$contact_id)->get();
        //$website_information = website_information::where('contact_id',$contact_id)->get();
        $countries = CountryListFacade::getList('en');

        return view('contact.create', compact('countries','contact','contactInformation','org_id'));


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
}
