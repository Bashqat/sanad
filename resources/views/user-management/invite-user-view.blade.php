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
	<input type="hidden" name="role" id="role" value="3">
	<div class="modal-body invite-user-sec">
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
				<a class="nav-item nav-link active role" id="admin-tab" role_attr="manager" data-toggle="tab" href="" role="tab" aria-controls="admin" aria-selected="true">Manager<i class="fa fa-check role-select-manager" aria-hidden="true"></i></a>
				<a class="nav-item nav-link role" id="employee-tab" role_attr="employee" data-toggle="tab" href="" role="tab" aria-controls="employee" aria-selected="false">Employee<i class="fa fa-check hide role-select-employee" aria-hidden="true"></i></a>
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
												<input type="radio" class="contact-checkbox" name="contact" value="view_contact"  id="checkboxPrimary1">
												<label for="checkboxPrimary1">
													View Contact Only
												</label>
											</div>
											<div class="icheck-primary">
												<input type="radio" class="contact-checkbox" name="contact" value="view_create_edit_contact" id="checkboxPrimary1">
												<label for="checkboxPrimary2">
													View Create and Edit Contact
												</label>
											</div>
										</div>

										<div class="form-group clearfix">
											<p>Allow Access only to the following Groups/Contacts:</p>
											<div class="form-group">
											<select data-placeholder="Select" name="group_contact_access[]" multiple class="chosen-select" tabindex="8">
												<option value=""></option>
												<option>All Conacts</option>
												<option>All Groups</option>
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
												<input type="checkbox" class="contact-checkbox" name="viewPassword" value="view_password" id="checkboxPrimary3">
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
					<div class="card">
						<!-- Card header -->
						<div class="card-header" role="tab" id="headingTwo2">
							<h5 class="mb-0">
								<input type="checkbox" name="sales" id="contact-sales-all">
								<a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="true">
									Sales <i class="fas fa-angle-down rotate-icon float-right"></i>
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
											<p>Invoice</p>
											<div class="icheck-primary">
												<input type="radio" class="contact-checkbox" name="invoice" value="create_draft_invoice"  id="checkboxPrimary1">
												<label for="checkboxPrimary1">
													Create Drafts Invoices Only
												</label>
											</div>
											<div class="icheck-primary">
												<input type="radio" class="contact-checkbox" name="invoice" value="create_approve_invoice" id="checkboxPrimary1">
												<label for="checkboxPrimary2">
													Create and approve Invoices
												</label>
											</div>
										</div>



										<div class="form-group clearfix">
											<div class="d-flex view-pswd-text">
												<p>Is He Allowed to apply payment to invoices?</p>
												<i class="far fa-question-circle fa-lg mt-2" data-toggle="tooltip" data-html="true" title="User Can apply Payments received to an issued invoices"></i>
											</div>
											<div class="icheck-primary">
												<input type="checkbox" class="contact-checkbox" name="invoicePayment" value="allow_invoice_payment" id="checkboxPrimary3">
												<label for="checkboxPrimary3">
													Allow Invoice Payment
												</label>
											</div>
											<div class="form-group clearfix">
												<p>Quote</p>
												<div class="icheck-primary">
													<input type="radio" class="contact-checkbox" name="quote" value="create_draft_quote"  id="checkboxPrimary1">
													<label for="checkboxPrimary1">
														Create Drafts Quotes Only
													</label>
												</div>
												<div class="icheck-primary">
													<input type="radio" class="contact-checkbox" name="quote" value="create_approve_quote" id="checkboxPrimary1">
													<label for="checkboxPrimary2">
														Create and approve Quotes
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>
					<div class="card">
						<!-- Card header -->
						<div class="card-header" role="tab" id="headingTwo2">
							<h5 class="mb-0">
								<input type="checkbox" name="accounting" id="contact-sales-all">
								<a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="true">
									Accounting <i class="fas fa-angle-down rotate-icon float-right"></i>
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
											<p>Manual Journals</p>
											<div class="icheck-primary">
												<input type="radio" class="contact-checkbox" name="journals" value="create_journal_draft"  id="checkboxPrimary1">
												<label for="checkboxPrimary1">
													Create Drafts Only
												</label>
											</div>
											<div class="icheck-primary">
												<input type="radio" class="contact-checkbox" name="journals" value="create_post_journal" id="checkboxPrimary1">
												<label for="checkboxPrimary2">
													Create and Post
												</label>
											</div>
										</div>



										<div class="form-group clearfix">
											<div class="d-flex view-pswd-text">
												<p>Is He Allowed to Lock date?</p>
												<i class="far fa-question-circle fa-lg mt-2" data-toggle="tooltip" data-html="true" title="User Can apply Locking Date were  no transaction will be allowed within stated date"></i>
											</div>
											<div class="icheck-primary">
												<input type="checkbox" class="contact-checkbox" value="allow_date_locking" name="dateLocking" id="checkboxPrimary3">
												<label for="checkboxPrimary3">
													Allow Date Locking
												</label>
											</div>
											<div class="form-group clearfix">
												<p>Reports</p>
												<div class="icheck-primary">
													<input type="radio" class="contact-checkbox" name="report" value="allow_view_run_report"  id="checkboxPrimary1">
													<label for="checkboxPrimary1">
														Allow to view and Run Reports
													</label>
												</div>
												<div class="icheck-primary">
													<input type="radio" class="contact-checkbox" name="report" value="allow_publish_report" id="checkboxPrimary1">
													<label for="checkboxPrimary2">
														Allow to Publish Reports
													</label>
												</div>
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
