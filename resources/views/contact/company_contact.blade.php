<div class="tab-pane active" id="settings">

      <form class="form-horizontal" method="POST" action="{{ (isset($contact) && !empty($contact[0])) ? route('contact.update'):route('contact.store',[$org_id]) }}" enctype="multipart/form-data">
          <input type="hidden" name="contact_type" value="company">
          @csrf
          @if(isset($contact) && !empty($contact[0]))
            <input type="hidden" name="id" value="{{$contact[0]->id}}">
            <input type="hidden" name="org_id" value="{{$org_id}}">
          @endif
          <div class="form-group row">
            <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Contact name in English <span style="color:red;">*</span> </label>
            <div class="col-lg-9 col-md-9 col-sm-8">
              <input type="text" name="contact[first_name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" Enter Contact Name" required="" value="{{ (isset($contact[0]->first_name))?$contact[0]->first_name:'' }}">
              @error('contacts.name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="name_arabic" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Contact  name in other language </label>
            <div class="col-lg-9 col-md-9 col-sm-8">
              <input type="text" name="contact[name_arabic]" class="form-control" placeholder=" Enter Contact Name" value="{{ (isset($contact[0]->name_arabic))?$contact[0]->name_arabic:'' }}">
              @error('name_arabic')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="account_no" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Account no# </label>
            <div class="col-lg-9 col-md-9 col-sm-8">
              <input type="text" name="contact[account_no]" class="form-control @error('contacts.account_no') is-invalid @enderror" placeholder="Enter Account no#" value="{{ (isset($contact[0]->account_no))?$contact[0]->account_no:'' }}">
              @error('contacts.account_no')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="logo" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Logo </label>
            <div class="col-lg-9 col-md-9 col-sm-8 input-group">
              @if(isset($contact[0]->logo) && $contact[0]->logo!="")
                <div class="thumb_img">
                    <img src="{{ url('/') }}/{{ isset($contact[0]->logo)?$contact[0]->logo:'' }}" class="img-thumbnail" placeholder="Image not found">
                </div>
                @endif
              <div class="custom-file">
                <input type="file" name="contact[logo]" class="form-control custom-file-input" accept="image/*">
                <label class="custom-file-label" for="logoFile">Choose file</label>
                @error('logo')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="business_registration_number" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Business registration number </label>
            <div class="col-lg-9 col-md-9 col-sm-8">
              <input type="text" name="contact[business_registration_number]" class="form-control" placeholder="Enter Business registration number" value="{{ (isset($contact[0]->business_registration_number))?$contact[0]->business_registration_number:'' }}">
              @error('business_registration_number')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="tax_registration_number" class="col-lg-3 col-md-3 col-sm-4 col-form-label">TAX registration number </label>
            <div class="col-lg-9 col-md-9 col-sm-8">
              <input type="text" name="contact[tax_registration_number]" class="form-control" placeholder="Enter TAX registration number" value="{{ (isset($contact[0]->tax_registration_number))?$contact[0]->tax_registration_number:'' }}">
              @error('tax_registration_number')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
    <div class="form-group row">
      <label for="location" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Location GPS,google maps </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[location]" class="form-control" placeholder="Enter Location GPS" value="{{ (isset($contact[0]->location))?$contact[0]->location:'' }}">
        @error('location')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row contact-row">
      <label for="phone" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Phone </label>
      <div class="d-flex contact-inputs col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[phone][country_code]" class="form-control " placeholder="Country Code" value="{{ (isset($contact[0]->phone['country_code']))?$contact[0]->phone['country_code']:'' }}">
        <input type="text" name="contact[phone][area]" class="form-control " placeholder="Area" value="{{ (isset($contact[0]->phone['area']))?$contact[0]->phone['area']:'' }}">
        <input type="tel" name="contact[phone][number]" class="form-control " placeholder="Number" value="{{ (isset($contact[0]->phone['number']))?$contact[0]->phone['number']:'' }}">
      </div>
    </div>
    <?php
    //echo '<pre>';

    //$phone=json_decode($contact[0]->phone);
    //print_r($phone);
    ?>
    <div class="form-group row contact-row">
      <label for="fax" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Fax </label>
      <div class="d-flex  contact-inputs col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[fax][country_code]" class="form-control " placeholder="Country Code" value="{{ (isset($contact[0]->fax['country_code']))?$contact[0]->phone['country_code']:'' }}">
        <input type="text" name="contact[fax][area]" class="form-control " placeholder="Area" value="{{ (isset($contact[0]->fax['area']))?$contact[0]->phone['area']:'' }}">
        <input type="tel" name="contact[fax][number]" class="form-control " placeholder="Number" value="{{ (isset($contact[0]->fax['number']))?$contact[0]->phone['number']:'' }}">
      </div>
    </div>
    <div class="form-group row contact-row">
      <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile </label>
      <div class="d-flex  contact-inputs col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[mobile][country_code]" class="form-control " placeholder="Country Code" value="{{ (isset($contact[0]->mobile['country_code']))?$contact[0]->mobile['country_code']:'' }}">
        <input type="text" name="contact[mobile][area]" class="form-control " placeholder="Area" value="{{ (isset($contact[0]->mobile['area']))?$contact[0]->mobile['area']:'' }}">
        <input type="tel" name="contact[mobile][number]" class="form-control " placeholder="Number" value="{{ (isset($contact[0]->mobile['number']))?$contact[0]->mobile['number']:'' }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="website" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Website </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="url" name="contact[website]" class="form-control" placeholder="Enter Website" value="{{ (isset($contact[0]->website))?$contact[0]->website:'' }}">
        @error('website')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Email </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="email" name="contact[email]" class="form-control" placeholder="Example@example.com" value="{{ (isset($contact[0]->email))?$contact[0]->email:'' }}">
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="form-group row">
      <label for="user_defined" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Addition field user defined </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[user_defined]" class="form-control" placeholder="Enter Addition filed user defined" value="{{ (isset($contact[0]->user_defined))?$contact[0]->user_defined:'' }}">
      </div>
    </div>
    <div class="form-group row">
      <label for="attachment" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Attachment </label>
      <div class="col-lg-9 col-md-9 col-sm-8 input-group">
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
    <div class="form-group row">
      <label for="notes" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Dashboard Notes </label>
      <div class="col-lg-9 col-md-9 col-sm-8">
        <input type="text" name="contact[notes]" class="form-control
                                    " placeholder="Enter Dashboard Notes" value="{{ (isset($contact[0]->notes))?$contact[0]->notes:'' }}">
      </div>
    </div>
    <input type="hidden" value="{{ json_encode($countries) }}" id="countryList">
    <!--  Address start -->

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
    <a href="javascript:void(0)" id="add_address" class="float-right mr-5" data-count="0">Add Another Address</a>
    <!--  Address end -->
    <!--  persons contacts start -->
    @if(isset($contact[0]->contact_information) && !empty($contact[0]->contact_information))
    @foreach($contact[0]->contact_information as $key=>$contact_information)
    <div class="persons_contacts">
      <h4 class="modal-title mt-5 mb-2">Person Contact</h4>
      <div class="form-group row">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label p-0"> </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <div class="person-contact">

          <input type="text" name="persons_contacts[{{$key}}][first_name]" class="form-control col-md-6" placeholder="First Name" value="{{ (isset($contact_information->first_name))?$contact_information->first_name:'' }}" >
          <input type="text" name="persons_contacts[{{$key}}][last_name]" class="form-control col-md-6" placeholder="Last Name" value="{{ (isset($contact_information->last_name))?$contact_information->first_name:'' }}"  >
            </div>
          <div class="person-contact">
          <input type="tel" name="persons_contacts[{{$key}}][nickname]" class="form-control col-md-6" placeholder="Nickname" value="{{ (isset($contact_information->nickname))?$contact_information->nickname:'' }}" >
          <input type="tel" name="persons_contacts[{{$key}}][position]" class="form-control col-md-6" placeholder="Job title" value="{{ (isset($contact_information->position))?$contact_information->position:'' }}">
          </div>
        </div>
      </div>
      <div class="form-group row contact-row">
        <label for="land_line" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Land Line </label>
        <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">

          <input type="text" name="persons_contacts[{{$key}}][land_line][country_code]" class="form-control col-md-3" placeholder="Country Code" value="{{ (isset($contact_information->land_line['country_code']))?$contact_information->land_line['country_code']:'' }}">
          <input type="text" name="persons_contacts[{{$key}}][land_line][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($contact_information->land_line['area']))?$contact_information->land_line['area']:'' }}">
          <input type="tel" name="persons_contacts[{{$key}}][land_line][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($contact_information->land_line['number']))?$contact_information->land_line['number']:'' }}">
          <input type="text" name="persons_contacts[{{$key}}][land_line][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($contact_information->land_line['extention']))?$contact_information->land_line['extention']:'' }}">
        </div>
      </div>
      @if(isset($contact_information->mobile) && !empty($contact_information->mobile))
      @foreach($contact_information->mobile as $key1=>$mobile)

      <div class="form-group row contact-row" id="mobile-field">
        <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile </label>
        <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
          <select name="persons_contacts[{{$key}}][mobile][{{$key1}}][type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
            <option value="">Select Type</option>
            <option value="main" {{(isset($mobile['area']) && $mobile['type']=='main')?'selected':''}}>Main</option>
            <option value="work" {{(isset($mobile['area']) && $mobile['type']=='work')?'selected':''}}>Work</option>
            <option value="whatsapp" {{(isset($mobile['area']) && $mobile['type']=='whatsapp')?'selected':''}}>Whatsapp</option>
          </select>
          <input type="text" name="persons_contacts[{{$key}}][mobile][{{$key1}}][area]" class="form-control col-md-3" placeholder="Area" value="{{ (isset($mobile['area']))?$mobile['area']:'' }}">
          <input type="tel" name="persons_contacts[{{$key}}][mobile][{{$key1}}][number]" class="form-control col-md-3" placeholder="Number" value="{{ (isset($mobile['number']))?$mobile['number']:'' }}">
          <input type="tel" name="persons_contacts[{{$key}}][mobile][{{$key1}}][extention]" class="form-control col-md-3" placeholder="Extention" value="{{ (isset($mobile['extention']))?$mobile['extention']:'' }}">
        </div>
      </div>
    @endforeach
    @else
    <div class="form-group row contact-row" id="mobile-field">
      <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile
       </label>
      <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
        <select name="persons_contacts[0][mobile][0][type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
          <option value="">Select Type</option>
          <option value="main">Main</option>
          <option value="work">Work</option>
          <option value="whatsapp">Whatsapp</option>
        </select>
        <input type="text" name="persons_contacts[0][mobile][0][area]" class="form-control col-md-3" placeholder="Area">
        <input type="tel" name="persons_contacts[0][mobile][0][number]" class="form-control col-md-3" placeholder="Number">
        <input type="tel" name="persons_contacts[0][mobile][0][extention]" class="form-control col-md-3" placeholder="Extention">
      </div>
    </div>
      @endif

      <a href="javascript:void(0)" class="float-right mr-5 mobile-clone" data-count="0">Add Another Mobile</a>
      <br>
      <br>
      <div class="form-group row email-field">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Email </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="email" name="persons_contacts[{{$key}}][email]" class="form-control" placeholder="Example@example.com" value="{{ (isset($contact_information->email))?$contact_information->email:'' }}">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Notes field </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <textarea name="persons_contacts[{{$key}}][notes]" class="form-control" placeholder="Notes">{{ (isset($contact_information->notes))?$contact_information->notes:'' }}</textarea>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="attachment" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Attachment </label>
        <div class="col-lg-9 col-md-9 col-sm-8 input-group">

          @if(isset($contact_information->attachment[0]) && $contact_information->attachment[0]!="")
            <div class="thumb_img">
                <img src="{{ url('/') }}/{{ isset($contact_information->attachment[0])?$contact_information->attachment[0]:'' }}" class="img-thumbnail" placeholder="Image not found">
            </div>
            @endif
          <div class="custom-file">
            <input type="file" name="persons_contacts[{{$key}}][attachment][]" class="form-control custom-file-input" accept="image/*, .pdf, .doc" multiple>
            <label class="custom-file-label" for="attachment">Choose file</label>
            @error('logo')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="user_defined" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Addition filed user defined </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="persons_contacts[{{$key}}][user_defined]" class="form-control" placeholder="Enter Addition filed user defined" value="{{ (isset($contact_information->user_defined))?$contact_information->user_defined:'' }}">
        </div>
      </div>
    </div>
    @endforeach
    @else
    <div class="persons_contacts">
      <h4 class="modal-title mt-5 mb-2">Person Contact</h4>
      <div class="form-group row">
        <label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label p-0"> </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <div class="person-contact">

          <input type="text" name="persons_contacts[0][first_name]" class="form-control col-md-6" placeholder="First Name" value="" >
          <input type="text" name="persons_contacts[0][last_name]" class="form-control col-md-6" placeholder="Last Name" >
            </div>
          <div class="person-contact">
          <input type="tel" name="persons_contacts[0][nickname]" class="form-control col-md-6" placeholder="Nickname" >
          <input type="tel" name="persons_contacts[0][position]" class="form-control col-md-6" placeholder="Job title">
          </div>
        </div>
      </div>
      <div class="form-group row contact-row">
        <label for="land_line" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Land Line </label>
        <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
          <input type="text" name="persons_contacts[0][land_line][country_code]" class="form-control col-md-3" placeholder="Country Code">
          <input type="text" name="persons_contacts[0][land_line][area]" class="form-control col-md-3" placeholder="Area">
          <input type="tel" name="persons_contacts[0][land_line][number]" class="form-control col-md-3" placeholder="Number">
          <input type="text" name="persons_contacts[0][land_line][extention]" class="form-control col-md-3" placeholder="Extention">
        </div>
      </div>
      <div class="form-group row contact-row" id="mobile-field">
        <label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile </label>
        <div class="col-lg-9 col-md-9 col-sm-8 person-sub-contact">
          <select name="persons_contacts[0][mobile][0][type]" class="form-control select2 col-md-3 select-input-field" style="width: 100%;">
            <option value="">Select Type</option>
            <option value="main">Main</option>
            <option value="work">Work</option>
            <option value="whatsapp">Whatsapp</option>
          </select>
          <input type="text" name="persons_contacts[0][mobile][0][area]" class="form-control col-md-3" placeholder="Area">
          <input type="tel" name="persons_contacts[0][mobile][0][number]" class="form-control col-md-3" placeholder="Number">
          <input type="tel" name="persons_contacts[0][mobile][0][extention]" class="form-control col-md-3" placeholder="Extention">
        </div>
      </div>
      <a href="javascript:void(0)" class="float-right mr-5 mobile-clone" data-count="0">Add Another Mobile</a>
      <br>
      <br>
      <div class="form-group row email-field">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Email </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="email" name="persons_contacts[0][email]" class="form-control" placeholder="Example@example.com" value="">
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Notes field </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <textarea name="persons_contacts[0][notes]" class="form-control" placeholder="Notes"></textarea>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="attachment" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Attachment </label>
        <div class="col-lg-9 col-md-9 col-sm-8 input-group">
          <div class="custom-file">
            <input type="file" name="persons_contacts[0][attachment][]" class="form-control custom-file-input" accept="image/*, .pdf, .doc" multiple>
            <label class="custom-file-label" for="attachment">Choose file</label>
            @error('logo')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="user_defined" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Addition filed user defined </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="persons_contacts[0][user_defined]" class="form-control" placeholder="Enter Addition filed user defined" value="">
        </div>
      </div>
    </div>
    @endif
    <a href="javascript:void(0)" class="float-right mr-5" id="add_person" data-count="0">Add Another Person</a>
    <!-- persons contacts end -->
    <!--  website information start -->
    @if(isset($contact[0]->website_information) && !empty($contact[0]->website_information))
    @foreach($contact[0]->website_information as $key=>$website_information)
    <div class="website_information">
      <h4 class="modal-title mt-5 mb-2">Website Information</h4>
      <div class="form-group row">
        <label for="title" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Title <span style="color:red;">*</span></label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="website_information[{{$key}}][title]" class="form-control" placeholder="Website Title(Supplier Portal)" value="{{ (isset($website_information->title))?$website_information->title:'' }}" required>
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="link" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Link </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="url" name="website_information[{{$key}}][link]" class="form-control" placeholder="Enter Link" value="{{ (isset($website_information->link))?$website_information->link:'' }}">
          @error('link')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="username" class="col-lg-3 col-md-3 col-sm-4 col-form-label">User Name </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="website_information[{{$key}}][username]" class="form-control" placeholder="Enter User Name" value="{{ (isset($website_information->username))?$website_information->username:'' }}">
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Password </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="password" name="website_information[{{$key}}][password]" class="form-control" placeholder="Enter Password" value="{{ (isset($website_information->password))?$website_information->password:'' }}">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>
    @endforeach
    @else
    <div class="website_information">
      <h4 class="modal-title mt-5 mb-2">Website Information</h4>
      <div class="form-group row">
        <label for="title" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Title <span style="color:red;">*</span></label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="website_information[0][title]" class="form-control" placeholder="Website Title(Supplier Portal)" value="{{ (isset($website_information->title))?$website_information->title:'' }}" required>
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="link" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Link </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="url" name="website_information[0][link]" class="form-control" placeholder="Enter Link" value="{{ (isset($website_information->link))?$website_information->link:'' }}">
          @error('link')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="username" class="col-lg-3 col-md-3 col-sm-4 col-form-label">User Name </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="text" name="website_information[0][username]" class="form-control" placeholder="Enter User Name" value="{{ (isset($website_information->username))?$website_information->username:'' }}">
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Password </label>
        <div class="col-lg-9 col-md-9 col-sm-8">
          <input type="password" name="website_information[0][password]" class="form-control" placeholder="Enter Password" value="{{ (isset($website_information->password))?$website_information->password:'' }}">
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
    </div>
    @endif

    <a href="javascript:void(0)" class="float-right mr-5" id="add_website" data-count="0">Add Another Website Information</a>
    <!-- website information end -->
    <br>
    <br>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10 text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
      </div>
    </div>
  </form>
</div>
