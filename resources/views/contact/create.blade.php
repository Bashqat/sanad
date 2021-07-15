@extends('layouts.app')
<title>Contacts</title>
@section('content')
<!-- Main content -->
<div class="container-fluid">
	<div class="row">
		<!-- /.col -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-header p-2">
					<ul class="nav nav-pills justify-content-end  px-3">
						<li class="nav-item">&nbsp;</li>
					</ul>
				</div><!-- /.card-header -->
				<div class="card-body">
					<div class="tab-content contact-create-sec">
						<div class="tab-pane active" id="settings">

							<form class="form-horizontal" method="POST" action="{{ route('contact.store',[$org_id]) }}" enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label for="name" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Contact name in English <span style="color:red;">*</span> </label>
									<div class="col-lg-9 col-md-9 col-sm-8">
										<input type="text" name="contact[name]" class="form-control @error('contacts.name') is-invalid @enderror" placeholder=" Enter Contact Name" required="" value="{{ old('contacts.name', '') }}">
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
										<input type="text" name="contact[name_arabic]" class="form-control" placeholder=" Enter Contact Name" value="{{ old('contacts.name_arabic', '') }}">
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
										<input type="text" name="contact[account_no]" class="form-control @error('contacts.account_no') is-invalid @enderror" placeholder="Enter Account no#" value="{{ old('contacts.account_no', '') }}">
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
										<input type="text" name="contact[business_registration_number]" class="form-control" placeholder="Enter Business registration number" value="{{ old('contacts.business_registration_number', '') }}">
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
										<input type="text" name="contact[tax_registration_number]" class="form-control" placeholder="Enter TAX registration number" value="{{ old('contacts.tax_registration_number', '') }}">
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
										<input type="text" name="contact[location]" class="form-control" placeholder="Enter Location GPS" value="">
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
										<input type="text" name="contact[phone][country_code]" class="form-control " placeholder="Country Code" value="{{ old('contacts.phone.country_code', '') }}">
										<input type="text" name="contact[phone][area]" class="form-control " placeholder="Area" value="{{ old('contacts.phone.area', '') }}">
										<input type="tel" name="contact[phone][number]" class="form-control " placeholder="Number" value="{{ old('contacts.phone.number', '') }}">
									</div>
								</div>
								<div class="form-group row contact-row">
									<label for="fax" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Fax </label>
									<div class="d-flex  contact-inputs col-lg-9 col-md-9 col-sm-8">
										<input type="text" name="contact[fax][country_code]" class="form-control " placeholder="Country Code" value="{{ old('contacts.fax.country_code', '') }}">
										<input type="text" name="contact[fax][area]" class="form-control " placeholder="Area" value="{{ old('contacts.fax.area', '') }}">
										<input type="tel" name="contact[fax][number]" class="form-control " placeholder="Number" value="{{ old('contacts.fax.number', '') }}">
									</div>
								</div>
								<div class="form-group row contact-row">
									<label for="mobile" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Mobile </label>
									<div class="d-flex  contact-inputs col-lg-9 col-md-9 col-sm-8">
										<input type="text" name="contact[mobile][country_code]" class="form-control " placeholder="Country Code" value="{{ old('contacts.mobile.country_code', '') }}">
										<input type="text" name="contact[mobile][area]" class="form-control " placeholder="Area" value="{{ old('contacts.mobile.area', '') }}">
										<input type="tel" name="contact[mobile][number]" class="form-control " placeholder="Number" value="{{ old('contacts.mobile.number', '') }}">
									</div>
								</div>
								<div class="form-group row">
									<label for="website" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Website </label>
									<div class="col-lg-9 col-md-9 col-sm-8">
										<input type="url" name="contact[website]" class="form-control" placeholder="Enter Website" value="http://">
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
										<input type="email" name="contact[email]" class="form-control" placeholder="Example@example.com" value="{{ old('contacts.email', '') }}">
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
										<input type="text" name="contact[user_defined]" class="form-control" placeholder="Enter Addition filed user defined" value="{{ old('contacts.user_defined', '') }}">
									</div>
								</div>
								<div class="form-group row">
									<label for="attachment" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Attachment </label>
									<div class="col-lg-9 col-md-9 col-sm-8 input-group">
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
                                                " placeholder="Enter Dashboard Notes" value="">
									</div>
								</div>
								<!--  Address start -->
								<div class="form-group row address-contact-row">
									<label for="address" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Address</label>
									<div class="col-lg-9 col-md-9 col-sm-8 contact-address-fields">
										<input type="text" name="contact[address][0][name]" class="form-control" placeholder="Address Name (e.g Head Office, Postal...etc)" value="">
										<input type="text" name="contact[address][0][address_line_1]" class="form-control" placeholder="Address Line 1">
										<input type="text" name="contact[address][0][address_line_2]" class="form-control" placeholder="Address Line 2">
										<div class="address-city-post-code">
											<input type="text" name="contact[address][0][city]" class="form-control" placeholder="City">
											<input type="text" name="contact[address][0][post_code]" class="form-control" placeholder="Post Code">
										</div>
										<select name="contact[address][0][country]" class="form-control select2 select-input-field" id="countrySelect">
											<option class="mmmm" value="">Select Country</option>
											@foreach ($countries as $value => $option )
											<option value="{{ $value }}">{{ $option }}</option>
											@endforeach
										</select>
										<input type="url" name="contact[address][0][google_map_link]" class="form-control" placeholder="Google Map Link">
									</div>
								</div>
								<a href="javascript:void(0)" id="add_address" class="float-right mr-5" data-count="0">Add Another Address</a>
								<!--  Address end -->
								<!--  persons contacts start -->
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
								<a href="javascript:void(0)" class="float-right mr-5" id="add_person" data-count="0">Add Another Person</a>
								<!-- persons contacts end -->
								<!--  website information start -->
								<div class="website_information">
									<h4 class="modal-title mt-5 mb-2">Website Information</h4>
									<div class="form-group row">
										<label for="title" class="col-lg-3 col-md-3 col-sm-4 col-form-label">Title <span style="color:red;">*</span></label>
										<div class="col-lg-9 col-md-9 col-sm-8">
											<input type="text" name="website_information[0][title]" class="form-control" placeholder="Website Title(Supplier Portal)" value="" required>
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
											<input type="url" name="website_information[0][link]" class="form-control" placeholder="Enter Link" value="http://">
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
											<input type="text" name="website_information[0][username]" class="form-control" placeholder="Enter User Name" value="">
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
											<input type="password" name="website_information[0][password]" class="form-control" placeholder="Enter Password" value="">
											@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
								</div>
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
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div><!-- /.card-body -->
			</div>
			<!-- /.nav-tabs-custom -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</div>
<!-- /.content -->
@endsection
@push('scripts')
 <script src="{{ url('js/contact.js') }}" defer></script>
@endpush
