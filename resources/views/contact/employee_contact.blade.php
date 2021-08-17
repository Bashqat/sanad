<div class="tab-pane active" id="settings">
  <?php
  $firstname='';
  $lastname='';
  $firstname_arabic='';
  $lastname_arabic='';
  if(isset($contact) && !empty($contact[0]))
  {
    $name=explode(" ",$contact[0]->name);
    $name_arabic=explode(" ",$contact[0]->name_arabic);
    $firstname=$name[0];
    $lastname=$name[1];
    $firstname_arabic=$name_arabic[0];
    $lastname_arabic=$name_arabic[1];

  }
  ?>
    <form class="form-horizontal" method="POST" action="{{ (isset($contact) && !empty($contact[0])) ? route('contact.employee.update'):route('contact.employee.store',[$org_id]) }}" enctype="multipart/form-data">
        <input type="hidden" name="contact_type" value="employee">
        @csrf
        @if(isset($contact) && !empty($contact[0]))
          <input type="hidden" name="id" value="{{$contact[0]->id}}">
          <input type="hidden" name="org_id" value="{{$org_id}}">
        @endif

        <div class="form-group row">
          <label for="name" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Contact name in English <span style="color:red;">*</span> </label>
          <div class="col-lg-4 col-md-3 col-sm-4">
            <input type="text" name="contact[first_name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" First Name" required="" value="{{ (isset($firstname))?$firstname:'' }}">
            @error('contacts.first_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <input type="text" name="contact[last_name]" class="form-control @error('contacts.first_name') is-invalid @enderror" placeholder=" Last Name" required="" value="{{ (isset($lastname))?$lastname:'' }}">
            @error('contacts.first_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <label for="name_arabic" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Contact  name in other language </label>
          <div class="col-lg-4 col-md-4 col-sm-5">
            <input type="text" name="contact[first_name_arabic]" class="form-control" placeholder=" First Name" value="{{ (isset($firstname_arabic))?$firstname_arabic:'' }}">
            @error('first_name_arabic')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-lg-4 col-md-4 col-sm-5">
            <input type="text" name="contact[last_name_arabic]" class="form-control" placeholder=" Last Name" value="{{ (isset($lastname_arabic))?$lastname_arabic:'' }}">
            @error('last_name_arabic')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

        </div>

      <div class="form-group row contact-row">
        <label for="land_line" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Land Line </label>

        <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
          <input type="text" name="contact[phone][0][country_code]" class="form-control col-md-3" placeholder="Country Code" value="{{ (isset($contact[0]->phone[0]['country_code']))?$contact[0]->phone[0]['country_code']:'' }}">
          <input type="text" name="contact[phone][0][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($contact[0]->phone[0]['area']))?$contact[0]->phone[0]['area']:'' }}">
          <input type="tel" name="contact[phone][0][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($contact[0]->phone[0]['number']))?$contact[0]->phone[0]['number']:'' }}">
          <input type="text" name="contact[phone][0][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($contact[0]->phone[0]['extention']))?$contact[0]->phone[0]['extention']:'' }}">
        </div>
      </div>
    @if(isset($contact[0]->mobile) && !empty($contact[0]->mobile))
      @foreach($contact[0]->mobile as $key=>$mobile)
      <div class="form-group row contact-row" id="mobile-field">
        <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
         </label>
        <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
          <select name="contact[mobile][{{$key}}][type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
            <option value="">Select Type</option>
            <option value="main" {{ (isset($mobile['type']) && $mobile['type']=='main')?'selected':'' }}>Main</option>
            <option value="work" {{ (isset($mobile['type']) && $mobile['type']=='work')?'selected':'' }}>Work</option>
            <option value="whatsapp" {{ (isset($mobile['type']) && $mobile['type']=='whatsapp')?'selected':'' }}>Whatsapp</option>
          </select>
          <input type="text" name="contact[mobile][{{$key}}][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($mobile['area']))?$mobile['area']:'' }}">
          <input type="tel" name="contact[mobile][{{$key}}][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($mobile['number']))?$mobile['number']:'' }}">
          <input type="tel" name="contact[mobile][{{$key}}][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($mobile['extention']))?$mobile['extention']:'' }}">
        </div>

      </div>
      @endforeach
    @else
      <div class="form-group row contact-row" id="mobile-field">
        <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
         </label>
        <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
          <select name="contact[mobile][0][type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
            <option value="">Select Type</option>
            <option value="main" {{ (isset($mobile['type']) && $mobile['type']=='main')?'selected':'' }}>Main</option>
            <option value="work" {{ (isset($mobile['type']) && $mobile['type']=='work')?'selected':'' }}>Work</option>
            <option value="whatsapp" {{ (isset($mobile['type']) && $mobile['type']=='whatsapp')?'selected':'' }}>Whatsapp</option>
          </select>
          <input type="text" name="contact[mobile][0][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($mobile['area']))?$mobile['area']:'' }}">
          <input type="tel" name="contact[mobile][0][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($mobile['number']))?$mobile['number']:'' }}">
          <input type="tel" name="contact[mobile][0][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($mobile['extention']))?$mobile['extention']:'' }}">
        </div>

      </div>
    @endif

      <a href="javascript:void(0)" class="float-right mr-5 mobile-clone-only" data-count="{{(isset($contact[0]->mobile) && !empty($contact[0]->mobile))?count($contact[0]->mobile)-1:0}}">Add Another Mobile</a>
      <br>
      @if(isset($contact[0]->email) && !empty($contact[0]->email))
        @foreach($contact[0]->email as $key=>$email)
      <div class="form-group row email-field">
        <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <input type="email" name="contact[email][{{$key}}]" class="form-control" placeholder="Example@example.com" value="{{$email}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      @endforeach
      @else
      <div class="form-group row email-field">
        <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <input type="email" name="contact[email][0]" class="form-control" placeholder="Example@example.com" value="">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      @endif
      <a href="javascript:void(0)" class="float-right mr-5 email_only" data-count="{{(isset($contact[0]->email) && !empty($contact[0]->email))?count($contact[0]->email)-1:0}}">Add Another Email</a>
      <br>


    <input type="hidden" value="{{ json_encode($countries) }}" id="countryList">
    <!--  Address start -->
@if(isset($contact[0]->address) && !empty($contact[0]->address) )
  @foreach($contact[0]->address as $key=>$address)

    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Address</label>

      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
        <input type="text" name="contact[address][{{$key}}][name]" class="form-control" placeholder="Address Name (e.g Head Office, Postal...etc)" value="{{ (isset($address['name']))?$address['name']:'' }}">
        <input type="text" name="contact[address][{{$key}}][address_line_1]" class="form-control" placeholder="Address Line 1" value="{{ (isset($address['address_line_1']))?$address['address_line_1']:'' }}">
        <input type="text" name="contact[address][{{$key}}][address_line_2]" class="form-control" placeholder="Address Line 2" value="{{ (isset($address['address_line_2']))?$address['address_line_2']:'' }}" >
        <div class="address-city-post-code">
          <input type="text" name="contact[address][{{$key}}][city]" class="form-control" placeholder="City" value="{{ (isset($address['city']))?$address['city']:'' }}">
          <input type="text" name="contact[address][{{$key}}][post_code]" class="form-control" placeholder="Post Code" value="{{ (isset($address['post_code']))?$address['post_code']:'' }}">
        </div>
        <select name="contact[address][{{$key}}][country]" class="form-control select2 select-input-field" id="countrySelect">
          <option class="mmmm" value="">Select Country</option>
          @foreach ($countries as $value => $option )
          <option value="{{ $value }}" {{(isset($address['country']) && ($value==$address['country']))?'selected':''}}>{{ $option }}</option>
          @endforeach
        </select>
        <input type="url" name="contact[address][0][google_map_link]" class="form-control" placeholder="Google Map Link" value="{{ (isset($address['google_map_link']))?$address['google_map_link']:'' }}">
      </div>
    </div>
    @endforeach
    @else
    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Address</label>

      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
        <input type="text" name="contact[address][0][name]" class="form-control" placeholder="Address Name (e.g Head Office, Postal...etc)" value="{{ (isset($contact[0]->address[0]['name']))?$contact[0]->address[0]['name']:'' }}">
        <input type="text" name="contact[address][0][address_line_1]" class="form-control" placeholder="Address Line 1" value="{{ (isset($contact[0]->address[0]['address_line_1']))?$contact[0]->address[0]['address_line_1']:'' }}">
        <input type="text" name="contact[address][0][address_line_2]" class="form-control" placeholder="Address Line 2" value="{{ (isset($contact[0]->address[0]['address_line_2']))?$contact[0]->address[0]['address_line_2']:'' }}" >
        <div class="address-city-post-code">
          <input type="text" name="contact[address][0][city]" class="form-control" placeholder="City" value="{{ (isset($contact[0]->address[0]['city']))?$contact[0]->address[0]['city']:'' }}">
          <input type="text" name="contact[address][0][post_code]" class="form-control" placeholder="Post Code" value="{{ (isset($contact[0]->address[0]['post_code']))?$contact[0]->address[0]['post_code']:'' }}">
        </div>
        <select name="contact[address][0][country]" class="form-control select2 select-input-field" id="countrySelect">
          <option class="mmmm" value="">Select Country</option>
          @foreach ($countries as $value => $option )
          <option value="{{ $value }}" {{isset($contact[0]->country) && ($option==$contact[0]->country)?'selected':''}}>{{ $option }}</option>
          @endforeach
        </select>
        <input type="url" name="contact[address][0][google_map_link]" class="form-control" placeholder="Google Map Link">
      </div>
    </div>
    @endif

    <a href="javascript:void(0)" id="add_address" class="float-right mr-5" data-count="{{(isset($contact[0]->address) && !empty($contact[0]->address))?count($contact[0]->address)-1:'0'}}">Add Another Address</a>
    <br><br>
    <!--  Address end -->
    <!--  persons contacts start -->

    <div class="form-group row">
      <label for="name" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Notes <span style="color:red;">*</span> </label>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <textarea name="contact[notes]" class="form-control @error('contacts.notes') is-invalid @enderror" placeholder=" Notes" required="" >{{ (isset($contact[0]->notes))?$contact[0]->notes:'' }}</textarea>
        @error('contacts.notes')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        @if (!empty($contact[0]->attachment))
                                @foreach ($contact[0]->attachment as $attachment )
                                    @switch( pathinfo($attachment, PATHINFO_EXTENSION) )
                                        @case('pdf')
                                            <a href="/{{ $attachment }}" target='_blank' class='attachment-link'><i class='far fa-file-pdf fa-3x'></i></a>
                                        @break
                                        @case('jpg')
                                        @case('jpeg')
                                        @case('png')
                                        @case('gif')
                                            <a href="/{{ $attachment }}" target="_blank" class="attachment-link">
                                                <img src="/{{$attachment}}" class="img-thumbnail" width="50" height="50">
                                            </a>
                                        @break
                                        @case('word')
                                            <a href="/{{$attachment}}" target="_blank" class="attachment-link"><i class="far fa-file-word fa-3x"></i></a>
                                        @break
                                        @default
                                            <a href="/{{ $attachment }}" target="_blank" class="attachment-link"><i class="far fa-file-pdf fa-3x"></i></a>
                                        @break

                                    @endswitch
                                    {{-- <div class="thumb_img">
                                        <img src="{{ url('/') }}/{{ $attachment }}" class="img-thumbnail">
                                    </div> --}}
                                @endforeach
                            @endif
                            <div class="custom-file">
                              <input type="file" name="contact[attachment][]" class="form-control custom-file-input" id="attachment" accept="image/*, .pdf, .doc" multiple>
                              <label class="custom-file-label" for="attachment">Choose file</label>
                              @error('logo')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
      </div>

    </div>
    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Employment Information
    </div>

    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">

          <input type="email" name="contact[emp_info][0][email]" class="form-control" placeholder="Example@example.com" value="{{(isset($contact[0]->emp_info[0]['email']) && $contact[0]->emp_info[0]['email']!=""?$contact[0]->emp_info[0]['email']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


      </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Employee work Id </label>
      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">

          <input type="text" name="contact[emp_info][0][employe_work_id]" class="form-control" placeholder="Employement Work id" value="{{(isset($contact[0]->emp_info[0]['employe_work_id']) && $contact[0]->emp_info[0]['employe_work_id']!=""?$contact[0]->emp_info[0]['employe_work_id']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


      </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Work Title </label>
      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">

          <input type="text" name="contact[emp_info][0][work_title]" class="form-control" placeholder="Work Title" value="{{(isset($contact[0]->emp_info[0]['work_title']) && $contact[0]->emp_info[0]['work_title']!=""?$contact[0]->emp_info[0]['work_title']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


      </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Work Grade </label>
      <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">

          <input type="text" name="contact[emp_info][0][work_grade]" class="form-control" placeholder="Work Grade" class="form-control" placeholder="Work Title" value="{{(isset($contact[0]->emp_info[0]['work_grade']) && $contact[0]->emp_info[0]['work_grade']!=""?$contact[0]->emp_info[0]['work_grade']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror


      </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Government id </label>
      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">

          <input type="text" name="contact[emp_info][0][gov_id]" class="form-control" placeholder="Government Id" value="{{(isset($contact[0]->emp_info[0]['gov_id']) && $contact[0]->emp_info[0]['gov_id']!=""?$contact[0]->emp_info[0]['gov_id']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>
        <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue </label>
        <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">

            <input type="date" name="contact[emp_info][0][gov_id_issue]" class="form-control" placeholder="Work Grade" value="{{(isset($contact[0]->emp_info[0]['gov_id_issue']) && $contact[0]->emp_info[0]['gov_id_issue']!=""?$contact[0]->emp_info[0]['gov_id_issue']:'')}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>
          <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry </label>
          <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">

              <input type="date" name="contact[emp_info][0][gov_id_expiry]" class="form-control" placeholder="Work Grade" value="{{(isset($contact[0]->emp_info[0]['gov_id_expiry']) && $contact[0]->emp_info[0]['gov_id_expiry']!=""?$contact[0]->emp_info[0]['gov_id_expiry']:'')}}">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Passport Detail </label>
      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">

          <input type="text" name="contact[emp_info][0][passport_gov_id]" class="form-control" placeholder="e.g 34345" value="{{(isset($contact[0]->emp_info[0]['passport_gov_id']) && $contact[0]->emp_info[0]['passport_gov_id']!=""?$contact[0]->emp_info[0]['passport_gov_id']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>
        <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue </label>
        <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">

            <input type="date" name="contact[emp_info][0][passport_gov_id_issue]" class="form-control" placeholder="Work Grade" value="{{(isset($contact[0]->emp_info[0]['passport_gov_id_issue']) && $contact[0]->emp_info[0]['passport_gov_id_issue']!=""?$contact[0]->emp_info[0]['passport_gov_id_issue']:'')}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

          </div>
          <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry </label>
          <div class="col-lg-2 col-md-2 col-sm-2 contact-address-fields">

              <input type="date" name="contact[emp_info][0][passport_gov_id_expiry]" class="form-control"  placeholder="Work Grade" value="{{(isset($contact[0]->emp_info[0]['passport_gov_id_expiry']) && $contact[0]->emp_info[0]['passport_gov_id_expiry']!=""?$contact[0]->emp_info[0]['passport_gov_id_expiry']:'')}}">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>
    </div>
    <div class="form-group row ">
      <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Work Starting Date </label>
      <div class="col-lg-3 col-md-3 col-sm-4 contact-address-fields">

          <input type="date" name="contact[emp_info][0][work_starting_date]" class="form-control" placeholder="Government Id" value="{{(isset($contact[0]->emp_info[0]['work_starting_date']) && $contact[0]->emp_info[0]['work_starting_date']!=""?$contact[0]->emp_info[0]['work_starting_date']:'')}}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

        </div>
      </div>
      <div class="form-group row address-contact-row">
        <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Personal Information
      </div><br>
      <div class="form-group row ">
        <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gender </label>
        <div class="col-lg-3 col-md-3 col-sm-4 contact-address-fields">

          <select name="contact[personal_info][0][gender]" class="form-control select2  select-input-field" style="width: 100%;">
            <option value="">Select</option>
            <option value="male" {{ (isset($contact[0]->personal_info[0]['gender']) && $contact[0]->personal_info[0]['gender']=='male')?'selected':'' }}>Male</option>
            <option value="female" {{ (isset($contact[0]->personal_info[0]['gender']) && $contact[0]->personal_info[0]['gender']=='female')?'selected':'' }}>Female</option>
            <option value="other" {{ (isset($contact[0]->personal_info[0]['gender']) && $contact[0]->personal_info[0]['gender']=='other')?'selected':'' }}>Other</option>
          </select>

          </div>
        </div>
        <div class="form-group row ">
          <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Blood Type </label>
          <div class="col-lg-3 col-md-3 col-sm-3 contact-address-fields">
            <select name="contact[personal_info][0][blood_group]" class="form-control select2  select-input-field" style="width: 100%;">
              <option value="">Select</option>
              <option value="a+" {{ (isset($contact[0]->personal_info[0]['blood_group']) && $contact[0]->personal_info[0]['blood_group']=='a+')?'selected':'' }}>A+</option>
              <option value="b+" {{ (isset($contact[0]->personal_info[0]['blood_group']) && $contact[0]->personal_info[0]['blood_group']=='b+')?'selected':'' }}>B+</option>
              <option value="o+" {{ (isset($contact[0]->personal_info[0]['blood_group']) && $contact[0]->personal_info[0]['blood_group']=='o+')?'selected':'' }}>O+</option>
            </select>

            </div>
          </div>
          <div class="form-group row ">
            <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Martial Status </label>
            <div class="col-lg-3 col-md-3 col-sm-4 contact-address-fields">
              <select name="contact[personal_info][0][martial_status]" class="form-control select2  select-input-field" style="width: 100%;">
                <option value="">Select</option>
                <option value="single" {{ (isset($contact[0]->personal_info[0]['martial_status']) && $contact[0]->personal_info[0]['martial_status']=='single')?'selected':'' }}>Single</option>
                <option value="married"  {{ (isset($contact[0]->personal_info[0]['martial_status']) && $contact[0]->personal_info[0]['martial_status']=='married')?'selected':'' }}>Married</option>

              </select>

              </div>
            </div>
            <div class="form-group row ">
              <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Place / Date of birth</label>
              <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                <select name="contact[personal_info][0][country]" class="form-control select2 select-input-field m-0" id="countrySelect">
                    <option class="mmmm" value="">Select Country</option>
                    @foreach ($countries as $value => $option )
                    <option value="{{ $value }}" {{(isset($contact[0]->personal_info[0]['country']) && ($value==$contact[0]->personal_info[0]['country']))?'selected':''}}>{{ $option }}</option>
                    @endforeach
                  </select>


                </div>
                <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                  <input type="text" name="contact[personal_info][0][city]" class="form-control" placeholder="City" value="{{(isset($contact[0]->personal_info[0]['city'])?$contact[0]->personal_info[0]['city']:'')}}">


                </div>
                <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Dob</label>
                  <div class="col-lg-3 col-md-3 col-sm-4 contact-address-fields">
                      <input type="date" name="contact[personal_info][0][dob]" class="form-control" placeholder="DOB" value="{{(isset($contact[0]->personal_info[0]['dob'])?$contact[0]->dob[0]['city']:'')}}">
                    </div>
            </div>
            <div class="form-group row ">
              <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Nationality</label>
              <div class="col-lg-4 col-md-4 col-sm-5 contact-address-fields">
                  <select name="contact[personal_info][0][nationality]" class="form-control select2 select-input-field" id="countrySelect">
                    <option class="mmmm" value="">Select Country</option>
                    @foreach ($countries as $value => $option )
                    <option value="{{ $value }}" {{(isset($contact[0]->personal_info[0]['nationality']) && ($value==$contact[0]->personal_info[0]['nationality']))?'selected':''}}>{{ $option }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row ">
                <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">User Defined </label>

                <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                    <input type="text" name="contact[personal_info][0][user_defined]" class="form-control" placeholder="User Defined" value="{{(isset($contact[0]->personal_info[0]['user_defined'])?$contact[0]->personal_info[0]['user_defined']:'')}}">
                </div>
              </div>
  @if(isset($contact[0]->emergency_contact) && !empty($contact[0]->emergency_contact))
    @foreach($contact[0]->emergency_contact as $key=>$emergency_contact)
        <div class="emergency-contact">
            <div class="form-group row address-contact-row">
              <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Emergency Contact Information ({{$key+1}})</label>
            </div>
            <div class="form-group row ">
              <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name </label>
              <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                  <input type="text" name="contact[emergency_contact][0][name]" class="form-control" placeholder="Name" value="{{(isset($emergency_contact['name'])?$emergency_contact['name']:'')}}">
              </div>
            </div>
            <div class="form-group row ">
              <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Relation </label>
              <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                  <input type="text" name="contact[emergency_contact][0][relation]" class="form-control" placeholder="Relation" value="{{(isset($emergency_contact['relation'])?$emergency_contact['relation']:'')}}">
              </div>
            </div>
            <div class="form-group row contact-row">
              <label for="land_line" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Land Line </label>

              <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                <input type="text" name="contact[emergency_contact][0][country_code]" class="form-control col-md-3" placeholder="Country Code" value="{{(isset($emergency_contact['country_code'])?$emergency_contact['country_code']:'')}}">
                <input type="text" name="contact[emergency_contact][0][area]" class="form-control col-md-3" placeholder="Area" value="{{(isset($emergency_contact['area'])?$emergency_contact['area']:'')}}">
                <input type="tel" name="contact[emergency_contact][0][number]" class="form-control col-md-3" placeholder="Number" value="{{(isset($emergency_contact['number'])?$emergency_contact['number']:'')}}">
                <input type="text" name="contact[emergency_contact][0][extention]" class="form-control col-md-3" placeholder="Extention" value="{{(isset($emergency_contact['extention'])?$emergency_contact['extention']:'')}}">
              </div>
            </div>
            <div class="form-group row contact-row" id="mobile-field">
              <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
               </label>
              <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                <select name="contact[emergency_contact][0][mobile_type]" class="form-control select2 col-md-3 select-input-field m-0" style="width: 100%;">
                  <option value="">Select Type</option>
                  <option value="main" {{ (isset($emergency_contact['mobile_type']) && $mobile['type']=='main')?'selected':'' }}>Main</option>
                  <option value="work" {{ (isset($emergency_contact['mobile_type']) && $emergency_contact['mobile_type']=='work')?'selected':'' }}>Work</option>
                  <option value="whatsapp" {{ (isset($emergency_contact['mobile_type']) && $emergency_contact['mobile_type']=='whatsapp')?'selected':'' }}>Whatsapp</option>
                </select>
                <input type="text" name="contact[emergency_contact][0][mobile_area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($emergency_contact['mobile_area']))?$emergency_contact['mobile_area']:'' }}">

                <input type="tel" name="contact[emergency_contact][0][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($emergency_contact['number']))?$emergency_contact['number']:'' }}">
                <input type="tel" name="contact[emergency_contact][0][mobile_extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($emergency_contact['mobile_extention']))?$emergency_contact['mobile_extention']:'' }}">
              </div>

            </div>
            <div class="form-group row ">
              <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
              <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                <div class="col-lg-9 col-md-9 col-sm-8">
                  <input type="email" name="contact[emergency_contact][0][email]" class="form-control" placeholder="Email" value="{{ (isset($emergency_contact['email']))?$emergency_contact['email']:'' }}">

                </div>

              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="emergency-contact">
              <div class="form-group row address-contact-row">
                <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Emergency Contact Information</label>
              </div>
              <div class="form-group row ">
                <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name </label>
                <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                    <input type="text" name="contact[emergency_contact][0][name]" class="form-control" placeholder="Name" value="">
                </div>
              </div>
              <div class="form-group row ">
                <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Relation </label>
                <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                    <input type="text" name="contact[emergency_contact][0][relation]" class="form-control" placeholder="Relation" value="">
                </div>
              </div>
              <div class="form-group row contact-row">
                <label for="land_line" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Land Line </label>

                <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                  <input type="text" name="contact[emergency_contact][0][country_code]" class="form-control col-md-3" placeholder="Country Code" value="">
                  <input type="text" name="contact[emergency_contact][0][area]" class="form-control col-md-3" placeholder="Area" value="">
                  <input type="tel" name="contact[emergency_contact][0][number]" class="form-control col-md-3" placeholder="Number" value="">
                  <input type="text" name="contact[emergency_contact][0][extention]" class="form-control col-md-3" placeholder="Extention" value="">
                </div>
              </div>
              <div class="form-group row contact-row" id="mobile-field">
                <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
                 </label>
                <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                  <select name="contact[emergency_contact][0][mobile_type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
                    <option value="">Select Type</option>
                    <option value="main" {{ (isset($mobile['type']) && $mobile['type']=='main')?'selected':'' }}>Main</option>
                    <option value="work" {{ (isset($mobile['type']) && $mobile['type']=='work')?'selected':'' }}>Work</option>
                    <option value="whatsapp" {{ (isset($mobile['type']) && $mobile['type']=='whatsapp')?'selected':'' }}>Whatsapp</option>
                  </select>
                  <input type="text" name="contact[emergency_contact][0][mobile_area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($mobile['area']))?$mobile['area']:'' }}">
                  <input type="tel" name="contact[emergency_contact][0][mobile_number]" class="form-control col-md-3" placeholder="Number" value="">
                  <input type="tel" name="contact[emergency_contact][0][mobile_extention]" class="form-control col-md-3" placeholder="Extention" value="">
                </div>

              </div>
              <div class="form-group row ">
                <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
                <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                    <input type="email" name="contact[emergency_contact][0][relation]" class="form-control" placeholder="Email" value="">

                </div>
              </div>
            </div>
          @endif
            <a href="javascript:void(0)" class="float-right mr-5 emergency_contact" data-count="{{(isset($contact[0]->mobile) && !empty($contact[0]->mobile))?count($contact[0]->mobile)-1:0}}">Add Another contact</a><br>

            @if(isset($contact[0]->dependent_info) && !empty($contact[0]->dependent_info) )
            @foreach($contact[0]->dependent_info as $key=>$dependent_info)
            <div class="dependent-information">
                <div class="form-group row address-contact-row">
                  <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Dependent Information({{$key+1}})</label>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label"></label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][first_name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" First Name" required="" value="{{(isset($dependent_info['first_name']) && $dependent_info['first_name']!="")? $dependent_info['first_name']:'' }}">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][last_name]" class="form-control @error('contacts.first_name') is-invalid @enderror" placeholder=" Last Name" required="" value="{{(isset($dependent_info['last_name']) && $dependent_info['last_name']!="")? $dependent_info['last_name']:'' }}">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label"></label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][relation]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder="Relation" required="" value="{{(isset($dependent_info['relation']) && $dependent_info['relation']!="")? $dependent_info['relation']:'' }}">

                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <select name="contact[dependent_info][0][gender]" class="form-control select2  select-input-field" style="width: 100%;">
                      <option value="">Gender</option>
                      <option value="male" {{(isset($dependent_info['gender']) && $dependent_info['gender']=="male")? 'selected':'' }} >Male</option>
                      <option value="female" {{(isset($dependent_info['gender']) && $dependent_info['gender']=="female")? 'selected':'' }} >Female</option>
                      <option value="other" {{(isset($dependent_info['gender']) && $dependent_info['gender']=="other")? 'selected':'' }}>Other</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Government id </label>
                  <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                      <input type="text" name="contact[dependent_info][0][gov_id]" class="form-control" placeholder="Government Id" value="{{(isset($dependent_info['gov_id']) && $dependent_info['gov_id']!="")? $dependent_info['gov_id']:'' }}">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue </label>
                    <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                        <input type="date" name="contact[dependent_info][0][gov_id_issue]" class="form-control" placeholder="Work Grade" value="{{(isset($dependent_info['gov_id_issue']) && $dependent_info['gov_id_issue']!="")? $dependent_info['gov_id_issue']:'' }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry </label>
                      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                          <input type="date" name="contact[dependent_info][0][gov_id_expiry]" class="form-control" placeholder="Work Grade" value="{{(isset($dependent_info['gov_id_expiry']) && $dependent_info['gov_id_expiry']!="")? $dependent_info['gov_id_expiry']:'' }}">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                </div>
                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Passport Detail </label>
                  <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                      <input type="text" name="contact[dependent_info][0][passport_gov_id]" class="form-control" placeholder="e.g 34345" value="{{(isset($dependent_info['passport_gov_id']) && $dependent_info['passport_gov_id']!="")? $dependent_info['passport_gov_id']:'' }}">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                      <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue </label>
                    <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                        <input type="date" name="contact[dependent_info][0][passport_gov_id_issue]" class="form-control" placeholder="Work Grade" value="{{(isset($dependent_info['passport_gov_id_issue']) && $dependent_info['passport_gov_id_issue']!="")? $dependent_info['passport_gov_id_issue']:'' }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                      </div>
                      <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry </label>
                      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                          <input type="date" name="contact[dependent_info][0][passport_gov_id_expiry]" class="form-control" placeholder="Work Grade" value="{{(isset($dependent_info['passport_gov_id_expiry']) && $dependent_info['passport_gov_id_expiry']!="")? $dependent_info['passport_gov_id_expiry']:'' }}">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror

                        </div>
                </div>

                <div class="form-group row contact-row" id="mobile-field">
                  <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
                   </label>

                  <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                    <select name="contact[dependent_info][0][mobile_type]" class="form-control select2 col-md-3 select-input-field m-0" style="width: 100%;">

                      <option value="">Select Type</option>
                      <option value="main" {{(isset($dependent_info['mobile_type']) && $dependent_info['mobile_type']=="main")? 'selected':'' }} >Main</option>
                      <option value="work" {{(isset($dependent_info['mobile_type']) && $dependent_info['mobile_type']=="work")? 'selected':'' }} >Work</option>
                      <option value="whatsapp" {{(isset($dependent_info['mobile_type']) && $dependent_info['mobile_type']=="whatsapp")? 'selected':'' }} >Whatsapp</option>
                    </select>
                    <input type="text" name="contact[dependent_info][0][mobile_area]" class="form-control col-md-3" placeholder="Area" value="{{(isset($dependent_info['mobile_area']) && $dependent_info['mobile_area']!="")? $dependent_info['mobile_area']:'' }}">
                    <input type="tel" name="contact[dependent_info][0][mobile_number]" class="form-control col-md-3" placeholder="Number" value="{{(isset($dependent_info['mobile_number']) && $dependent_info['mobile_number']!="")? $dependent_info['mobile_number']:'' }}">
                    <input type="tel" name="contact[dependent_info][0][mobile_extention]" class="form-control col-md-3" placeholder="Extention" value="{{(isset($dependent_info['mobile_extention']) && $dependent_info['mobile_extention']!="")? $dependent_info['mobile_extention']:'' }}">
                  </div>

                </div>
                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
                  <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                      <input type="email" name="contact[dependent_info][0][email]" class="form-control" placeholder="Email" value="{{(isset($dependent_info['email']) && $dependent_info['email']!="")? $dependent_info['email']:'' }}">
                  </div>
                </div>

              <div class="form-group row">
                <label for="name" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Notes </label>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <textarea name="contact[dependent_info][0][notes]" class="form-control @error('contacts.notes') is-invalid @enderror" placeholder=" Notes" required="" >{{(isset($dependent_info['notes']) && $dependent_info['notes']!="")? $dependent_info['notes']:'' }}</textarea>
                  @error('contacts.first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <label for="name" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Attachment </label>
                <div class="col-lg-3 col-md-3 col-sm-4">

                                      <div class="custom-file">
                                        <input type="file" name="contact[dependent_info][0][attachment][]" class="form-control custom-file-input" id="attachment" accept="image/*, .pdf, .doc" multiple>
                                        <label class="custom-file-label" for="attachment">Choose file</label>

                                      </div>
                </div>

              </div>
              </div>

            @endforeach
            @else
            <div class="dependent-information">
                <div class="form-group row address-contact-row">
                  <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Dependent Information</label>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label"></label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][first_name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" First Name" required="" value="">
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][last_name]" class="form-control @error('contacts.first_name') is-invalid @enderror" placeholder=" Last Name" required="" value="">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-lg-4 col-md-4 col-sm-4 col-form-label"></label>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <input type="text" name="contact[dependent_info][0][relation]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder="Relation" required="" value="">

                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-4">
                    <select name="contact[dependent_info][0][gender]" class="form-control select2  select-input-field" style="width: 100%;">
                      <option value="">Gender</option>
                      <option value="male" >Male</option>
                      <option value="female" >Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Government id </label>
                  <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                      <input type="text" name="contact[dependent_info][0][gov_id]" class="form-control" placeholder="Government Id" value="">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue</label>
                    <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                        <input type="date" name="contact[dependent_info][0][gov_id_issue]" class="form-control" placeholder="Work Grade" value="">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                      </div>
                      <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry</label>
                      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                          <input type="date" name="contact[dependent_info][0][gov_id_expiry]" class="form-control" placeholder="Work Grade" value="">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror

                        </div>
                </div>
                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Passport Detail </label>
                  <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                      <input type="text" name="contact[dependent_info][0][passport_gov_id]" class="form-control" placeholder="e.g 34345" value="">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Issue </label>
                    <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                        <input type="date" name="contact[dependent_info][0][passport_gov_id_issue]" class="form-control" placeholder="Work Grade" value="">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                      <label for="email" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Expiry </label>
                      <div class="col-lg-2 col-md-2 col-sm-4 contact-address-fields">
                          <input type="date" name="contact[dependent_info][0][passport_gov_id_expiry]" class="form-control" placeholder="Work Grade" value="">
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror

                        </div>
                </div>

                <div class="form-group row contact-row" id="mobile-field">
                  <label for="mobile" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Mobile
                   </label>
                  <div class="col-lg-8 col-md-8 col-sm-8 person-sub-contact">
                    <select name="contact[dependent_info][0][mobile_type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
                      <option value="">Select Type</option>
                      <option value="main" >Main</option>
                      <option value="work" >Work</option>
                      <option value="whatsapp" >Whatsapp</option>
                    </select>
                    <input type="text" name="contact[dependent_info][0][mobile_area]" class="form-control col-md-3" placeholder="Area" value="">
                    <input type="tel" name="contact[dependent_info][0][mobile_number]" class="form-control col-md-3" placeholder="Number" value="">
                    <input type="tel" name="contact[dependent_info][0][mobile_extention]" class="form-control col-md-3" placeholder="Extention" value="">
                  </div>

                </div>
                <div class="form-group row ">
                  <label for="email" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Email </label>
                  <div class="col-lg-8 col-md-8 col-sm-8 contact-address-fields">
                      <input type="email" name="contact[dependent_info][0][email]" class="form-control" placeholder="Email" value="">

                  </div>
                </div>

              <div class="form-group row">
                <label for="name" class="col-lg-4 col-md-4 col-sm-4 col-form-label">Notes  </label>
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <textarea name="contact[dependent_info][0][notes]" class="form-control @error('contacts.notes') is-invalid @enderror" placeholder=" Notes" required="" ></textarea>
                  @error('contacts.first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <label for="name" class="col-lg-1 col-md-1 col-sm-4 col-form-label">Attachment</label>
                <div class="col-lg-3 col-md-3 col-sm-4">

                                      <div class="custom-file">
                                        <input type="file" name="contact[dependent_info][0][attachment][]" class="form-control custom-file-input" id="attachment" accept="image/*, .pdf, .doc" multiple>
                                        <label class="custom-file-label" for="attachment">Choose file</label>

                                      </div>
                </div>

              </div>
              </div>

            @endif
            <a href="javascript:void(0)" class="float-right mr-5 dependent_info" data-count="{{(isset($contact[0]->mobile) && !empty($contact[0]->mobile))?count($contact[0]->mobile)-1:0}}">Add Another Dependent</a>
    <!-- persons contacts end -->
    <!--  website information start -->

    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10 text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
      </div>
    </div>
  </form>
</div>
