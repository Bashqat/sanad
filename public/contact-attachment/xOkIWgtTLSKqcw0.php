@extends('layouts.contact_layout')

@section('content')
{{-- Assign Group Modal --}}
@include('contact.group-modal')
{{-- Add Group Modal --}}
@include('contact.add-group-modal')
{{-- Add Tag Modal --}}
@include('contact.add-tag-modal')
{{-- Add merge Modal --}}
@include('contact.merge-contact-modal')
<div class="english-table">
	<div class="container-fluid">
		<div class="row contact-view-profile-header align-items-center">
            <div class="col-md-7">
                <div class="contact-profile-info d-flex align-items-center">
                    <div class="profile-back-btn d-flex align-items-center">
                        <img src="/images/site-images/profile-back.svg">
                        <p class="mb-0">Back</p>
                    </div>
                    <div class="conatct-profile-img">
                        <img src="/images/site-images/profile-img.svg">
                    </div>
                    <div class="contact-profile-details text-capitalize text-right">
                        <h5>{{$contact_detail[0]['name']}}</h5>
                        <p class="mb-0">{{$contact_detail[0]['name_arabic']}}</p>
                    </div>
                </div>
            </div>
						<input type="hidden" name="org_id" value="{{$org_id}}" class="org_id">
			<div class="col-md-5">
                <div class="conatct-view-search-options d-flex justify-content-end">
                    <form class="form-inline contact-side-bar-search contact-table-search">
                        <div class="input-group input-group-sm">
                            <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                            <div class="input-search-append">
                                <button class="btn d-flex align-items-center" type="submit">
                                    <!-- <i class="fas fa-search"></i> -->
                                    <img src="/images/site-images/noun_Search_1.svg">
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="dropdown contact-view-options">
                        <button class="btn dropdown-toggle custom-btn bg-white mb-0 drop-button" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Options
                            <!-- <i class="fa fa-caret-down" aria-hidden="true"></i> -->
                            <img src="/images/site-images/view-con-opt.svg">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu" style="">
                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio" type="radio"  name="flexRadioDefault" id="flexRadioDefault1">
                            <a class="dropdown-item show-contact-option" data-type="group" data-row="{{$contact_detail[0]['id']}}">Add to group</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio" type="radio"  name="flexRadioDefault" id="flexRadioDefault1">
                            <a class="dropdown-item show-contact-option" data-type="tag" data-row="{{$contact_detail[0]['id']}}">Add tag</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio" type="radio"  name="flexRadioDefault" id="flexRadioDefault1">
                            <a class="dropdown-item show-contact-option contact_merge" href="#" data-type="merge" url="/organisation/{{$org_id}}/contact-merge" data-id="contacts_table" data-type="merge" data-row="{{$contact_detail[0]['id']}}">Merge</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio" type="radio"  name="flexRadioDefault" id="flexRadioDefault1">
                            <a class="dropdown-item " href="{{route('contact.id.archive',[$org_id,$contact_detail[0]['id']])}}" data-type="archive" >Archive</a>
                            </div>

                            <div class="dropdown-footer-btns d-flex align-items-center justify-content-between">
                                <button class="btn dropdown-cancel-btn">Cancel</button>
                                <button class="btn dropdown-save-btn">Save</button>
                            </div>

                        </div>
                    </div>
                    <a href="{{route('contacts.edit',[$org_id,$contact_detail[0]['id']])}}" class="btn custom-btn btn-primary edit-button mb-0">Edit</a>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-9">
        <div class="contact-view-website contact-tables-sec  bg-white">
					<div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-6 d-flex align-items-center p-0">
                            <button class="right-conatct-arrow btn collapsed arrow_input" type="button" data-toggle="collapse" data-target="#websites-table-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
                                    <!-- <i class="fa fa-angle-down"></i> -->
                                    <img src="/images/site-images/cont-view-right-arrow.svg" class="cont-view-right-arrow" id="arrow_id1">
                                    <img src="/images/site-images/cont-view-up-arrow.svg" class="cont-view-up-arrow" id="arrow_id2">
                                </h1>
							</button>
                           <h5 class="text-capitalize">websites</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end p-0">
                            <button class="btn add-btn d-flex align-items-center" data-toggle="modal" data-target="#add-website-modal">
<!--                                <i class="fa fa-plus border rounded-circle p-1"></i>-->
                                <img src="/images/site-images/add-website.svg">
                                Add New Website</button>
                        </div>

					</div>

					<div class="collapse contact-inner-table-sec" id="websites-table-box" style="">
                        <table class="w-100 border-0">
                          <thead>
                            <tr>
                             <th></th>
                              <th>Website Name</th>
                              <th>Link</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th></th>
                                <th></th>
                            </tr>
                          </thead>
                          <tbody>
														@if(!empty($contact_detail[0]['website_information']))
														@foreach($contact_detail[0]['website_information'] as $website)
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td>{{$website['title']}}</td>
                                <td>{{$website['link']}}</td>
                                <td>{{$website['username']}}</td>
                                <td><img src="/images/site-images/cont-view-psd.svg" > <span id="pin-{{$website['id']}}">*************</span></td>
                                <td><img src="/images/site-images/cont-view-eye.svg" class="view_pin" data_id="{{$website['id']}}" data_org_id="{{$org_id}}"> View</td>
                                <td><div class="dropdown table-dropdown show">
                                    <button class="btn " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <img src="/images/site-images/3-dots-cont-view.svg">
                                        </button>
                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 34px, 0px);" x-placement="bottom-start">
                                        <a class="dropdown-item d-flex align-items-center" href="#&quot;">
                                        <img src="/images/site-images/archive-table-data.svg"> <form class="inline-block" action="{{route('website.archive',[$org_id,$website['id']])}}" method="POST" onsubmit="return confirm(`Are you sure?`);">
																					@csrf
																					<input type="submit" class="dropdown-item" value="Archive Website">
											                  </form>
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                        <img src="/images/site-images/delete-table-data.svg"> <form class="inline-block" action="{{route('website.delete',[$org_id,$website['id']])}}" method="POST" onsubmit="return confirm(`Are you sure?`);">
																					@csrf
																					<input type="submit" class="dropdown-item" value="Delete Website">
											                  </form>
                                        </a>
                                    </div>
                                </div></td>
                            </tr>
														@endforeach
														@endif

                          </tbody>
                        </table>

				    </div>
				</div>



                <div class="contact-view-contact-person-list contact-tables-sec  bg-white mb-4">
					<div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-6 d-flex align-items-center p-0">
                             <button class="btn right-conatct-arrow arrow_input" type="button" data-toggle="collapse" data-target="#contact-persons-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
<!--                                    <i class="fa fa-angle-down"></i>-->
                                    <img src="/images/site-images/cont-view-right-arrow.svg" class="cont-view-right-arrow" id="arrow_id1">
                                    <img src="/images/site-images/cont-view-up-arrow.svg" class="cont-view-up-arrow" id="arrow_id2">
                                 </h1>
							</button>
                          <h5 class="text-capitalize">Contact Persons List</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end p-0">
                            <div class="dropdown c-p-l-opt">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--									<i class="fa fa-list mr-1 p-1"></i>-->
                                    View</button>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu">
                                <a class="dropdown-item contact_info_column" data-column="0" href="#">Name</a>
									<a class="dropdown-item contact_info_column" data-column="1" href="#">Nickname</a>
									<a class="dropdown-item contact_info_column" data-column="2" href="#">Position</a>
									<a class="dropdown-item contact_info_column" data-column="3" href="#">Contacts</a>
									<a class="dropdown-item contact_info_column" data-column="4" href="#">Notes</a>
									<a class="dropdown-item contact_info_column" data-column="5" href="#">Attachment</a>

								</div>
							</div>
                            <div class="dropdown c-p-l-opt">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--                                    <i class="fa fa-cog"></i>-->
									Options
								</button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu">
									<a class="dropdown-item" data-toggle="modal" href="javascript:void(0);" data-target="#modal-default">Create group</a>
									<a class="dropdown-item option" href="/person-assign-group" data-type="person-assign-group" data-id="contact_persons_table">Add to group</a>
									<a class="dropdown-item option" href="/contact-information-delete" data-type="contact-information-delete" data-id="contact_persons_table">Delete Contact</a>
									<a class="dropdown-item option" href="/person-remove-group" data-type="person-remove-group" data-id="contact_persons_table">Delete Group</a>
								</div>
                            </div>
                        </div>

					</div>
					<div class="collapse contact-inner-table-sec" id="contact-persons-box">
                        <table class="w-100 border-0">
                          <thead>
                            <tr>
                            <th></th>
                              <th>Person Name</th>
                              <th>Nick Name</th>
                                <th>Position</th>
                                <th>Contact</th>
                                <th>Notes</th>
                                <th>Attacments</th>
                                <th></th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr class="contact-group-heading">
                                <th></th>
                                <th colspan="7">Group 1</th>
                            </tr>
														@if(!empty($contact_detail[0]['contact_information']))
														@foreach($contact_detail[0]['contact_information'] as $contact)
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td><a href="#">{{$contact['first_name']}}</a></td>
                                <td>{{$contact['nickname']}}</td>
                                <td>{{$contact['position']}}</td>
                                <td>
                                    <div class="contact-person-list-details d-inline-flex">
                                    <div class="dropdown show media-contact">
                                            <button class="btn  d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <!--                                    <i class="fa fa-cog"></i>-->
                                                <img src="/images/site-images/c-p-l-email.svg">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-132px, 28px, 0px);" x-placement="bottom-end">
                                                 <div class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#modal-default">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/email-icon.svg">
                                                    Work:
                                                    </h4>
                                                    <a href="#">abc@gmail.com</a>
                                                 </div>
                                                 <div class="dropdown-item option d-flex align-items-center" data-type="" data-id="">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/email-icon.svg">
                                                    Personal:
                                                    </h4>
                                                    <a href="#">xyz@gmail.com</a>
                                                 </div>


                                            </div>
                                        </div>

                                        <div class="dropdown show media-contact">
                                            <button class="btn  d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <!--                                    <i class="fa fa-cog"></i>-->
                                                    <img src="/images/site-images/c-p-l-phone.svg">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-132px, 28px, 0px);" x-placement="bottom-end">
                                                 <div class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#modal-default">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/phone-icon.svg">
                                                    Work:
                                                    </h4>
                                                    <a href="#">+966-65373935</a>
                                                 </div>
                                                 <div class="dropdown-item option d-flex align-items-center" data-type="" data-id="">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/phone-icon.svg">
                                                    Personal:
                                                    </h4>
                                                    <a href="#">+966-65373935</a>
                                                 </div>
                                                 <div class="dropdown-item option d-flex align-items-center" data-type="" data-id="">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/phone-icon.svg">
                                                    Other:
                                                    </h4>
                                                    <a href="#">+966-66373935</a>
                                                 </div>
                                            </div>
                                        </div>

                                        <div class="dropdown show media-contact">
                                            <button class="btn  d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <!--                                    <i class="fa fa-cog"></i>-->
                                                     <img src="/images/site-images/c-p-l-wtap.svg">
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="custom-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-132px, 28px, 0px);" x-placement="bottom-end">
                                                 <div class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#modal-default">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/wtapp-icon.svg">
                                                    Work:
                                                    </h4>
                                                    <a href="#">+966-65373935</a>
                                                 </div>
                                                 <div class="dropdown-item option d-flex align-items-center" data-type="" data-id="">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/wtapp-icon.svg">
                                                    Personal:
                                                    </h4>
                                                    <a href="#">+966-65373935</a>
                                                 </div>
                                                 <div class="dropdown-item option d-flex align-items-center" data-type="" data-id="">
                                                    <h4 class="d-flex align-items-center"><img src="/images/site-images/wtapp-icon.svg">
                                                    Other:
                                                    </h4>
                                                    <a href="#">+966-66373935</a>
                                                 </div>
                                            </div>
                                        </div>


                                    </div>
                                </td>
                                <td>
                                    <textarea type="text" placeholder="Type here">{{$contact['notes']}}</textarea>
                                </td>
                                <td>
                                    <img src="/images/site-images/c-p-l-pdf.svg">
                                </td>
                                <td>
																	<a class="file-attachment" data-id="{{$contact['id']}}" data-contact-id="{{$contact['contact_id']}}">   <img src="/images/site-images/c-p-l-pdf.svg">
																	</a>
                                </td>
                            </tr>
														@endforeach
														@endif
                            <!-- <tr class="contact-group-heading">
                              <th></th>
                                <th colspan="7">Group 1</th>
                            </tr>
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td><a href="#">Keith Wilaim</a></td>
                                <td>Marco</td>
                                <td>Manager</td>
                                <td>
                                   <div class="contact-person-list-details d-inline-flex">
                                        <img src="/images/site-images/c-p-l-email.svg">
                                        <img src="/images/site-images/c-p-l-phone.svg">
                                        <img src="/images/site-images/c-p-l-wtap.svg">
                                    </div>
                                </td>
                                <td>
                                    <textarea type="text" placeholder="Type here"></textarea>
                                </td>
                                <td>
                                    <div class="contact-pdf-data d-flex align-items-center">
                                        <img src="/images/site-images/c-p-l-pdf.svg">(03)
                                    </div>
                                </td>
                                <td>
                                    <img src="/images/site-images/3-dots-cont-view.svg">
                                </td>
                            </tr> -->
                          </tbody>
                        </table>

				    </div>
				</div>



                <!-- Notes-tables-start-here -->
                <div class="contact-tables-sec bg-white notes-tables-sec">
    <div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-12 d-flex align-items-center p-0">
                             <button class="btn right-conatct-arrow" type="button" data-toggle="collapse" data-target="#note-tables-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
<!--                                    <i class="fa fa-angle-down"></i>-->
                                    <img src="/images/site-images/cont-view-right-arrow.svg">
                                 </h1>
							</button>
                          <h5 class="text-capitalize">Additonal Notes and Attachments</h5>
                        </div>

					</div>

    <div class="collapse" id="note-tables-box">
                     <div class="nav-header-menu d-flex align-items-center">
                         <div class="col-md-6 d-flex align-items-center p-0">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="notes-tab-contact" data-toggle="tab" href="#notes-contact" role="tab" aria-controls="home" aria-selected="true">Notes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="email-tab-contact" data-toggle="tab" href="#email-contact" role="tab" aria-controls="profile" aria-selected="false">Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="activity-log-tab-contact" data-toggle="tab" href="#activity-log-contact" role="tab" aria-controls="messages" aria-selected="false">Activity History</a>
                                    </li>
                                </ul>
                         </div>
                         <div class="col-md-6 d-flex align-items-center justify-content-end p-0">
                              <button class="btn add-btn d-flex align-items-center" data-toggle="modal" data-target="#add-note-modal">
                <!--             <i class="far fa-sticky-note mr-1"></i>-->
                                <img src="/images/site-images/add-website.svg">
                                Add New Note
                             </button>
                         </div>
                    </div>


					<!-- Tab panes -->

						<div class="tab-content">
							<div class="tab-pane active" id="notes-contact" role="tabpanel" aria-labelledby="notes-tab-contact">
                                <div class="notes-contact-inner-table-sec contact-inner-table-sec">
                                    <table class="w-100 border-0">
                                    <tbody>
                                        <tr>
                                        <td><input type="checkbox" class="" value=""></td>
                                            <td><span>Heading will be here</span>
                                                <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.
                                                    Lorem ipsum may be used as a placeholder before final copy is available.
                                                </p>
                                                <div class="notes-time-detail d-flex">
                                                    <span>By Keith Willaim </span>
                                                    <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="nots-attach-pdf d-flex align-items-center">
                                                    <img src="/images/site-images/c-p-l-pdf.svg">(03)
                                                    <img src="/images/site-images/contact-nots-pin.svg">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td><input type="checkbox" class="" value=""></td>
                                            <td><span>Heading will be here</span>
                                                <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.
                                                    Lorem ipsum may be used as a placeholder before final copy is available.
                                                </p>
                                                <div class="notes-time-detail d-flex">
                                                    <span>By Keith Willaim </span>
                                                    <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="/images/site-images/c-p-l-pdf.svg">(03)
                                                <img src="/images/site-images/contact-nots-pin.svg">
                                            </td>
                                        </tr>
                                        <tr>
                                        <td><input type="checkbox" class="" value=""></td>
                                            <td><span>Heading will be here</span>
                                                <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.
                                                    Lorem ipsum may be used as a placeholder before final copy is available.
                                                </p>
                                                <div class="notes-time-detail d-flex">
                                                    <span>By Keith Willaim </span>
                                                    <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="/images/site-images/c-p-l-pdf.svg">(03)
                                                <img src="/images/site-images/contact-nots-pin.svg">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>



                            </div>
							<div class="tab-pane" id="email-contact" role="tabpanel" aria-labelledby="email-tab-contact">
                                <h2>tab222</h2>

							</div>
							<div class="tab-pane" id="activity-log-contact" role="tabpanel" aria-labelledby="activity-log-tab-contact">
                                 <h2>tab33333</h2>

                                                                    <!-- PAGINATION-START -->

                                							</div>
						</div>
					</div>

				</div>
                <!-- Notes-tables-end-here -->




        </div>
        <div class="col-md-3">

        <aside class="bg-white contact-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Contact Details</h4>
					</div>
					<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
							<li>
                                <div class="d-flex justify-content-between">
                                    <p>Account Number:</p>
                                    <b>{{$contact_detail[0]['account_no']}}</b>
                                </div>
                            </li>
														@if(!empty($contact_detail[0]['website_information']))
														@foreach($contact_detail[0]['website_information'] as $website)

														<li>
                                <a href="#" class="d-inline-flex">
                                <img src="/images/site-images/contact-globe.svg">
                              {{$website['link']}}
                                </a>
                            </li>
														@endforeach
														@endif

                            <li>
                                <div class="d-flex justify-content-between">
                                    <p>Phone Number:</p>
                                    <b>+{{(isset($contact_detail[0]['phone']['number'])?$contact_detail[0]['phone']['number']:'')}}</b>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between">
                                    <p>Fax Number:</p>
                                    <b>+{{(isset($contact_detail[0]['fax']['number'])?$contact_detail[0]['fax']['number']:'')}}</b>
                                </div>
                            </li>

							</ul>

					</div>
				</aside>


                <aside class="bg-white contact-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Address</h4>
					</div>
					<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
                            <li>
                                <p>{{isset($contact_detail[0]['address'][0]['name'])?$contact_detail[0]['address'][0]['name']:''}}</p>
                            </li>
                            <li>
                                <p>{{isset($contact_detail[0]['address'][0]['city'])?$contact_detail[0]['address'][0]['city']:''}}</p>
                            </li>
							<li>
                                <div class="d-flex justify-content-between">
                                    <p>Country:</p>
                                    <b>{{isset($contact_detail[0]['address'][0]['country'])?$contact_detail[0]['address'][0]['country']:''}}</b>
                                </div>
                            </li>
							<li>

                                <a href="#" class="d-inline-flex">
                                <img src="/images/site-images/address-location-cont.svg">
                                {{isset($contact_detail[0]['address'][0]['google_map_link'])?$contact_detail[0]['address'][0]['google_map_link']:''}}
                                </a>
                            </li>
							</ul>

					</div>
				</aside>


            <aside class="bg-white contact-detail-sec contact-groups-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Groups</h4>
					</div>
				<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
									@if(isset($contactGroup) && !empty($contactGroup))
										@foreach($contactGroup as $group)
                            <li>
                                <p>{{$group['title']}}</p>
                            </li>

											@endforeach
										@endif
							</ul>

                        <div class="tags-btns overflow-auto">
													<div class="sidebar-top d-flex justify-content-between align-items-center">
                                <h4 class="text-capitalize mb-0">tags</h4>
						                </div>

													@if(!empty($contact_detail[0]['tags']))
													@foreach($contact_detail[0]['tags'] as $tags)
                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">{{$tags}}</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>

														@endforeach
															@endif



					</div>
				</aside>





        </div>

        </div>
    </div>
</div>
{{-- ADD WEBSITE MODAL --}}
<div class="modal fade" id="add-website-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Website</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('organisation.contact.add_website') }}" id="add-website-form">
				<div class="modal-body add-gp-sec">
					@csrf
					<input type="hidden" name="contact_id" value="{{ $contact_detail[0]['id'] }}">
					<input type="hidden" name="org_id" value="{{ $org_id }}">
					<div class="form-group">
						<label for="title" class="col-form-label">Website Name:</label>
						<input type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="form-group">
						<label for="link" class="col-form-label">Link:</label>
						<input type="url" class="form-control" id="link" name="link" required>
					</div>
					<div class="form-group">
						<label for="username" class="col-form-label">Username:</label>
						<input type="text" class="form-control" id="username" name="username" required>
					</div>
					<div class="form-group">
						<label for="password" class="col-form-label">Password:</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Modal-PIN -->
<div class="modal contact-attachements-modal fade" id="file_attachment" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header align-items-center">
				<h5 class="modal-title" id="pinModal">Attachements View</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="listFolder" class="modal-body">

		</div>
	</div>
</div>
</div>


<div class="modal fade" id="new_folder_modal" tabindex="-1" role="dialog" aria-labelledby="pinModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content enter-pin-sec">
			<div class="modal-header">
				<h5 class="modal-title" id="pinModal">New folder</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" id="form-rename-folder" action="">
					@csrf
					<input type="hidden" name="folder_id" value="" class="rename_folder_id">


					<div class="form-group">
						<label for="folder_name">New name</label>
						<input type="text" class="form-control"  name="folder_name" id="folder_name" placeholder="Folder Name">
				</div>
				<div class="form-group">
						<button type="click" class="btn tab-file-upload-btn d-flex align-items-center" id="update_folder_name" >Update</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<script src="{{ url('js/contact.js') }}" defer></script>
<script>

    $(document).ready(function(){
  		$(".arrow_input").click(function(){
   			$(this).closest('.contact-tables-sec').toggleClass("active-contact-table-sec");
  			});
 //  $(“.cont-view-up-arrow”).click(function(){
 //    $(this).closest(‘.contact-tables-sec’).removeClass(“active-contact-table-sec”);
 // });
});
    </script>
@endsection
