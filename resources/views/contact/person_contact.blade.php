<div class="tab-pane active" id="settings">
  @php
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
  @endphp

  <form class="form-horizontal" method="POST" action="{{ (isset($contact) && !empty($contact[0])) ? route('contact.update'):route('contact.store',[$org_id]) }}" enctype="multipart/form-data">
    <input type="hidden" name="contact_type" value="person">
    @csrf
    @if(isset($contact) && !empty($contact[0]))
    <input type="hidden" name="id" value="{{$contact[0]->id}}">
    <input type="hidden" name="org_id" value="{{$org_id}}">
    @endif
    <div class="form-group row contact-row">
      <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Contact name in English <span style="color:red;">*</span> </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="person-contact name-contact-field ">
            <input type="text" name="contact[first_name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" First Name"  value="{{ (isset($firstname))?$firstname:'' }}" required>
            @error('contacts.first_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror

            <input type="text" name="contact[last_name]" class="form-control @error('contacts.first_name') is-invalid @enderror" placeholder=" Last Name"  value="{{ (isset($lastname))?$lastname:'' }}" required>
            @error('contacts.first_name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

    </div>
    <div class="form-group row contact-row">
      <label for="name_arabic" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Contact name in other language  </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="person-contact name-contact-field">
          <input type="text" name="contact[first_name_arabic]" class="form-control" placeholder=" First Name" value="{{ (isset($firstname_arabic))?$firstname_arabic:'' }}" >
          @error('first_name_arabic')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror

          <input type="text" name="contact[last_name_arabic]" class="form-control" placeholder=" Last Name" value="{{ (isset($lastname_arabic))?$lastname_arabic:'' }}">
          @error('last_name_arabic')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <!-- <div class="col-lg-4 col-md-4 col-sm-4">
        <input type="text" name="contact[last_name_arabic]" class="form-control" placeholder=" Last Name" value="{{ (isset($lastname_arabic))?$lastname_arabic:'' }}">
        @error('last_name_arabic')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div> -->

    </div>
    <div class="form-group row">
      <label for="account_no" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Account no# </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[account_no]" class="form-control @error('contacts.account_no') is-invalid @enderror" placeholder="Enter Account no#" value="{{ (isset($contact[0]->account_no))?$contact[0]->account_no:'' }}" >
        @error('contacts.account_no')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Nickname </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[nickname]" class="form-control" placeholder="Enter Nickname" value="{{ (isset($contact[0]->nickname))?$contact[0]->nickname:'' }}">
        @error('nickname')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>


    <div class="form-group row">
      <label for="user_defined" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Position </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[position]" class="form-control" placeholder="Position" value="{{ (isset($contact[0]->position))?$contact[0]->position:'' }}">
      </div>
    </div>
    <div class="form-group row contact-row">
      <label for="land_line" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Land Line </label>

      <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
        <input type="text" name="contact[phone][0][country_code]" class="form-control col-md-3" placeholder="Country Code" value="{{ (isset($contact[0]->phone[0]['country_code']))?$contact[0]->phone[0]['country_code']:$location }}" >
        <input type="text" name="contact[phone][0][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($contact[0]->phone[0]['area']))?$contact[0]->phone[0]['area']:'' }}" >
        <input type="tel" name="contact[phone][0][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($contact[0]->phone[0]['number']))?$contact[0]->phone[0]['number']:'' }}" >
        <input type="text" name="contact[phone][0][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($contact[0]->phone[0]['extention']))?$contact[0]->phone[0]['extention']:'' }}" >
      </div>
    </div>

    @if(isset($contact[0]->mobile) && !empty($contact[0]->mobile))
    @foreach($contact[0]->mobile as $key=>$mobile)
    <div class="form-group row contact-row" id="mobile-field">
      <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile
       </label>
      <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
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
    @else<div class="form-group row contact-row" id="mobile-field">
      <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile
       </label>
      <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
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
    <a href="javascript:void(0)" class="float-right mobile-clone-only" data-count="{{(isset($contact[0]->mobile) && !empty($contact[0]->mobile))?count($contact[0]->mobile)-1:0}}">Add Another Mobile</a>
    <br>
    <br>
    <div class="form-group row email-field email-field-small">
      <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Email </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="email" name="contact[email]" class="form-control" placeholder="Example@example.com" value="{{ (isset($contact[0]->email))?$contact[0]->email:'' }}" >
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>


    <input type="hidden" value="{{ json_encode($countries) }}" id="countryList">
    <!--  Address start -->
    <?php //echo '<pre>';print_R($contact[0]->address); ?>
@if(isset($contact[0]->address) && !empty($contact[0]->address) )
  @foreach($contact[0]->address as $key=>$address)

    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Address</label>

      <div class="col-lg-9 col-md-9 col-sm-8 contact-address-fields">
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
        <input type="url" name="contact[address][{{$key}}][google_map_link]" class="form-control" placeholder="Google Map Link" value="{{ (isset($address['google_map_link']))?$address['google_map_link']:'' }}">
      </div>
    </div>
    @endforeach
    @else
    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Address</label>

      <div class="col-lg-9 col-md-9 col-sm-8 contact-address-fields">
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

    <a href="javascript:void(0)" id="add_address" class="float-right" data-count="{{(isset($contact[0]->address) && !empty($contact[0]->address))?count($contact[0]->address)-1:'0'}}">Add Another Address</a>
    <br><br>
    <!--  Address end -->
    <!--  persons contacts start -->

    <div class="form-group row contact-row">
      <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Notes <span style="color:red;">*</span> </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <div class="person-contact notes-contact">
        <textarea name="contact[notes]" class="form-control @error('contacts.notes') is-invalid @enderror" placeholder=" Notes" >{{ (isset($contact[0]->first_name))?$contact[0]->first_name:'' }}</textarea>
        @error('contacts.first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror

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
      <!-- <div class="col-lg-4 col-md-4 col-sm-4">
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
      </div> -->

    </div>
    <div class="form-group row address-contact-row">
      <label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Financial Information</label>

      <div class="col-lg-9 col-md-9 col-sm-8 contact-address-fields">

        <input type="text" name="contact[financial_information][0][registration_number]" class="form-control" placeholder="User Registration number" value="{{ (isset($contact[0]->financial_information[0]['registration_number']))?$contact[0]->financial_information[0]['registration_number']:'' }}">


        <select name="contact[financial_information][0][sales_tax_rate]" class="form-control select2 select-input-field" id="countrySelect">
          <option class="mmmm" value="">Default Sales tax rate</option>
          <option value="0" {{(isset($contact[0]->financial_information[0]['sales_tax_rate']) && $contact[0]->financial_information[0]['sales_tax_rate']==0)?'selected':''}}>0%</option>
          <option value="1" {{(isset($contact[0]->financial_information[0]['sales_tax_rate']) && $contact[0]->financial_information[0]['sales_tax_rate']==1)?'selected':''}}>1%</option>
        </select>
        <select name="contact[financial_information][0][purchase_tax_rate]" class="form-control select2 select-input-field" id="countrySelect">
          <option class="mmmm" value="">Default Purchase tax rate</option>
          <option value="0" {{(isset($contact[0]->financial_information[0]['purchase_tax_rate']) && $contact[0]->financial_information[0]['sales_tax_rate']==1)?'selected':''}}>0%</option>
          <option value="1" {{(isset($contact[0]->financial_information[0]['purchase_tax_rate']) && $contact[0]->financial_information[0]['purchase_tax_rate']==1)?'selected':''}}>1%</option>
      </select>


      </div>
    </div>

    <!-- persons contacts end -->
    <!--  website information start -->
  <div class="form-footer">
      <div class="form-group row mb-0">
         <div class="col-6 text-left">
            <a href="{{ URL::previous() }}" class="btn btn-cancle">Cancel</a>
         </div>
        <div class="col-6 text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
  </div>

  </form>
</div>
