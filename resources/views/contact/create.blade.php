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
						@if(!isset($contact[0]->contact_type) )
								<input type="radio" class="contact_type" name="contact_type" value='person' checked>Person
								<input type="radio" class="contact_type" name="contact_type" value='employee'>employee
								<input type="radio" class="contact_type" name="contact_type" value='company'>company
						@endif

						@if(isset($contact[0]->contact_type) && $contact[0]->contact_type=="person" )
						<div class="contact_form person_contact">
							@include('contact.person_contact')
						</div>
						@elseif(isset($contact[0]->contact_type) && $contact[0]->contact_type!="company" && $contact[0]->contact_type!="employee" )

						<div class="contact_form person_contact" >
							@include('contact.person_contact')
						</div>
						@elseif(!isset($contact[0]->contact_type))

						<div class="contact_form person_contact" >
							@include('contact.person_contact')
						</div>

						@endif





						@if(isset($contact[0]->contact_type) && $contact[0]->contact_type=="employee" )
						<div class="contact_form employee_contact">
							@include('contact.employee_contact')
						</div>
						@elseif(!isset($contact[0]->contact_type))
						<div class="contact_form employee_contact"  style="display:none">
							@include('contact.employee_contact')
						</div>
						@endif

						@if(isset($contact[0]->contact_type) && $contact[0]->contact_type=="company" )
						<div class="contact_form company_contact">
							@include('contact.company_contact')
						</div>
						@elseif(!isset($contact[0]->contact_type))
						<div  class="contact_form company_contact" style="display:none">
							@include('contact.company_contact')
						</div>
						@endif
						<!-- /.tab-pane -->

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
