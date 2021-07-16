@extends('layouts.app')

@section('content')
@error('name')
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@enderror
@error('recipientEmail')
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<strong>{{ $message }}</strong>
</div>
@enderror
<form method="POST" action="{{ route('org-users-management.invite-user') }}" class="user-mang-view-sec">
	<div class="modal-body">
		@csrf
		<input type="hidden" name="organization" value="{{ $org_id }}">
		<div class="row">
				<div class="col-lg-8 col-md-10">
		<div class="form-group row">
			<div class="col-lg-3 col-md-2 col-sm-3">
				<label for="name" class="col-form-label">Name:</label>
			</div>
			<div class="col-lg-9 col-md-10 col-sm-9">
				<input type="text" name="name" class="form-control" id="name">
			</div>
		</div>

		<div class="form-group row">
			<div class="col-lg-3 col-md-2 col-sm-3">
				<label for="recipientEmail" class="col-form-label">Recipient Email:</label>
			</div>
			<div class="col-lg-9 col-md-10 col-sm-9">
				<input type="email" name="recipientEmail" class="form-control" id="recipientEmail">
			</div>
		</div>
			</div>
		</div>

		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link disabled" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Manager</a>
				<a class="nav-item nav-link active" id="employee-tab" data-toggle="tab" href="#employee" role="tab" aria-controls="employee" aria-selected="false">Employee</a>
				<i class="far fa-question-circle mr-2 fa-2x" data-toggle="tooltip" data-html="true" title="A Manager can invite other users and grant the same authority he has or lesser" style="margin-left: auto;"></i>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">Content 1</div>
			<div class="tab-pane fade show active" id="employee" role="tabpanel" aria-labelledby="employee-tab">
				<!--Accordion wrapper-->
				<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
					<!-- Accordion card -->
					<div id="accordion">
					<div class="card">
						<!-- Card header -->
						<div class="card-header">
							<h5 class="mb-0">
								<input type="checkbox" name="sales">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" class="card-link" aria-expanded="true">
									Sales <i class="fas fa-angle-down rotate-icon float-right"></i>
								</a>
							</h5>
						</div>
						<!-- Card body -->
						<div id="collapseOne1" class="collapse show">
							<div class="card-body">
							</div>
						</div>
					</div>
					<!-- Accordion card -->

					<!-- Accordion card -->

					<div class="card">
						<!-- Card header -->
						<div class="card-header" role="tab" id="headingTwo2">
							<h5 class="mb-0">
								<input type="checkbox" name="contacts" id="contact-check-all">
								<a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="true">
									Contacts <i class="fas fa-angle-down rotate-icon float-right"></i>
								</a>
							</h5>
						</div>
						<!-- Card body -->
						<div id="collapseTwo2" class="collapse show">
							<div class="card-body auth-update-view-body">
								<div class="row">
									<div class="col-sm-12">
										<!-- checkbox -->
										<div class="form-group clearfix">
											<p>How much access do they need?</p>
											<div class="icheck-primary">
												<input type="checkbox" class="contact-checkbox" name="viewOnly" id="checkboxPrimary1">
												<label for="checkboxPrimary1">
													View Contact Only
												</label>
											</div>
											<div class="icheck-primary">
												<input type="checkbox" class="contact-checkbox" name="viewEdit" id="checkboxPrimary2">
												<label for="checkboxPrimary2">
													View and Edit Contact
												</label>
											</div>
										</div>

										<div class="form-group clearfix">
											<p>Allow Access only to the following Groups/Contacts:</p>
											<div class="form-group">
												<select name="contactList" class="form-control select2" style="width: 100%;">
													<option>All Contact</option>
													<option>All</option>
												</select>
											</div>
										</div>

										<div class="form-group clearfix">
											<div class="d-flex view-pswd-text">
												<p>Is He Allowed to view Password field whithin the Contact details?</p>
												<i class="far fa-question-circle fa-lg mt-2" data-toggle="tooltip" data-html="true" title="User will be prompted upon sign into choose a Pin"></i>
											</div>
											<div class="icheck-primary">
												<input type="checkbox" class="contact-checkbox" name="viewPassword" id="checkboxPrimary3">
												<label for="checkboxPrimary3">
													View Password
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<!-- Accordion card -->
				</div>
				<!-- Accordion wrapper -->
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="{{ URL::previous() }}" class="btn btn-secondary common-button-site">Cancel</a>
<!--		 <button type="button" class="btn btn-secondary common-button-site" data-dismiss="modal">Cancel</button> -->
		<button type="submit" class="btn btn-primary common-button-site">Send Invite</button>
	</div>
</form>

@endsection
