@extends('layouts.contact_layout')

@section('content')

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
                        <h5>Person_Name</h5>
                        <p class="mb-0">person-name</p>
                    </div>
                </div>
            </div>
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
                    <div class="dropdown">
                        <button class="btn dropdown-toggle custom-btn bg-white mb-0 drop-button" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Options 
                            <!-- <i class="fa fa-caret-down" aria-hidden="true"></i> -->
                            <img src="/images/site-images/view-con-opt.svg">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="custom-menu" style="">
                            <a class="dropdown-item show-contact-option" data-type="group" data-row="26">Add to group</a>
                            <a class="dropdown-item show-contact-option" data-type="tag" data-row="26">Add tag</a>
                            <a class="dropdown-item show-contact-option" data-type="merge" data-row="26">Merge</a>
                            <a class="dropdown-item show-contact-option" data-type="archive" data-row="26">Archive</a>
                        </div>
                    </div>
                    <a href="#" class="btn custom-btn btn-primary edit-button mb-0">Edit</a>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-9">
        <div class="english-table-inner border p-3 bg-white mb-4">
					<div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-6 d-flex align-items-center">
                            <button class="btn collapsed" type="button" data-toggle="collapse" data-target="#websites-table-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
                                    <!-- <i class="fa fa-angle-down"></i> -->
                                    <img src="/images/site-images/cont-view-right-arrow.svg">
                                </h1>
							</button>
                           <h5 class="text-capitalize">websites</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button class="btn add-btn d-flex align-items-center" data-toggle="modal" data-target="#add-website-modal">
<!--                                <i class="fa fa-plus border rounded-circle p-1"></i>-->
                                <img src="/images/site-images/add-website.svg">
                                Add New Website</button>
                        </div>
                        
					</div>
    
					<div class="collapse" id="websites-table-box" style="">
                        <table class="w-100">
                          <thead>
                            <tr>
                              <th>Website Name</th>
                              <th>Link</th>
                                <th>User Name</th>
                                <th>Password</th>
                                <th></th>
                                <th></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td>ABC Name</td>
                                <td>https://dribbble.com</td>
                                <td>Test0100</td>
                                <td><img src="/images/site-images/cont-view-psd.svg"> *************</td>
                                <td><img src="/images/site-images/cont-view-eye.svg"> View</td>
                                <td><img src="/images/site-images/3-dots-cont-view.svg"></td>
                            </tr>
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td>ABC Name</td>
                                <td>https://dribbble.com</td>
                                <td>Test0100</td>
                                <td><img src="/images/site-images/cont-view-psd.svg"> *************</td>
                                <td><img src="/images/site-images/cont-view-eye.svg"> View</td>
                                <td><img src="/images/site-images/3-dots-cont-view.svg"></td>
                            </tr>
                          </tbody>
                        </table>
					
				    </div>
				</div>



                <div class="english-table-inner border p-3 bg-white mb-4">
					<div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-6 d-flex align-items-center">
                             <button class="btn" type="button" data-toggle="collapse" data-target="#contact-persons-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
<!--                                    <i class="fa fa-angle-down"></i>-->
                                    <img src="/images/site-images/cont-view-right-arrow.svg">
                                 </h1>
							</button>
                          <h5 class="text-capitalize">Contact Persons List</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <div class="dropdown">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--									<i class="fa fa-list mr-1 p-1"></i>-->
                                    View</button>
								<div class="dropdown-menu" aria-labelledby="custom-menu">
									<a class="dropdown-item" href="#">Check columns list</a>
								</div>
							</div>
                            <div class="dropdown">
								<button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--                                    <i class="fa fa-cog"></i>-->
									Options
								</button>
                                <div class="dropdown-menu" aria-labelledby="custom-menu">
									<a class="dropdown-item" data-toggle="modal" href="javascript:void(0);" data-target="#modal-default">Create group</a>
									<a class="dropdown-item option" href="/person-assign-group" data-type="person-assign-group" data-id="contact_persons_table">Add to group</a>
									<a class="dropdown-item option" href="/contact-information-delete" data-type="contact-information-delete" data-id="contact_persons_table">Delete Contact</a>
									<a class="dropdown-item option" href="/person-remove-group" data-type="person-remove-group" data-id="contact_persons_table">Delete Group</a>
								</div>
                            </div>
                        </div>
						
					</div>
					<div class="collapse " id="contact-persons-box">
                        <table class="w-100">
                          <thead>
                            <tr>
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
                            <tr>
                                <th colspan="7">Group 1</th>
                            </tr>
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td><a href="#">Keith Wilaim</a></td>
                                <td>Marco</td>
                                <td>Manager</td>
                                <td>
                                    <img src="/images/site-images/c-p-l-email.svg">
                                    <img src="/images/site-images/c-p-l-phone.svg">
                                    <img src="/images/site-images/c-p-l-wtap.svg">
                                </td>
                                <td>
                                    <textarea type="text" placeholder="Type here"></textarea>
                                </td>
                                <td>
                                    <img src="/images/site-images/c-p-l-pdf.svg">
                                </td>
                                <td>
                                    <img src="/images/site-images/3-dots-cont-view.svg">
                                </td>
                            </tr>
                               <tr>
                                <th colspan="7">Group 1</th>
                            </tr>
                            <tr>
                              <td><input type="checkbox" class="row-select" value="4"></td>
                              <td><a href="#">Keith Wilaim</a></td>
                                <td>Marco</td>
                                <td>Manager</td>
                                <td>
                                    <img src="/images/site-images/c-p-l-email.svg">
                                    <img src="/images/site-images/c-p-l-phone.svg">
                                    <img src="/images/site-images/c-p-l-wtap.svg">
                                </td>
                                <td>
                                    <textarea type="text" placeholder="Type here"></textarea>
                                </td>
                                <td>
                                    <img src="/images/site-images/c-p-l-pdf.svg">
                                </td>
                                <td>
                                    <img src="/images/site-images/3-dots-cont-view.svg">
                                </td>
                            </tr>
                          </tbody>
                        </table>
						
				    </div>
				</div>


               
                <!-- Notes-tables-start-here -->
                <div class="english-table-inner border p-3 bg-white mb-4 notes-tables-sec">
    <div class="table-header-menu d-flex align-items-center">
                        <div class="col-md-12 d-flex align-items-center">
                             <button class="btn" type="button" data-toggle="collapse" data-target="#note-tables-box" aria-expanded="false" aria-controls="collapseExample">
								<h1 class="mb-0">
<!--                                    <i class="fa fa-angle-down"></i>-->
                                    <img src="/images/site-images/cont-view-right-arrow.svg">
                                 </h1>
							</button>
                          <h5 class="text-capitalize">Additonal Notes and Attachments</h5>
                        </div>
						
					</div>
    
    <div class="collapse" id="note-tables-box">
                     <div class="table-header-menu d-flex align-items-center">
                         <div class="col-md-6 d-flex align-items-center">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                         <div class="col-md-6 d-flex align-items-center justify-content-end">
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
                            <table>
                                <tbody>
                                    <tr>
                                    <td><input type="checkbox" class="" value=""></td>
                                        <td><span>Heading will be here</span>
                                            <p>Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. 
                                                Lorem ipsum may be used as a placeholder before final copy is available.
                                            </p>
                                            <span>By Keith Willaim </span>
                                            <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
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
                                            <span>By Keith Willaim </span>
                                            <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
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
                                            <span>By Keith Willaim </span>
                                            <p>(Last edited by - Mark Boucher - 9/7/2021 - 7:33 AM)</p>
                                        </td>
                                        <td>
                                            <img src="/images/site-images/c-p-l-pdf.svg">(03)
                                            <img src="/images/site-images/contact-nots-pin.svg">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                
                                    
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

        <aside class="p-3 bg-white pb-5 mb-5 contact-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Contact Details</h4>
					</div>
					<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
							<li>
                                <div class="d-flex justify-content-between">
                                    <p>Account Number:</p>
                                    <b>00129310</b>
                                </div>
                            </li>
							<li>
                                <a href="#">
                                <img src="/images/site-images/contact-globe.svg">
                                https://dribbble.com
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                <img src="/images/site-images/contact-globe.svg">
                                https://dribbble.com
                                </a>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between">
                                    <p>Phone Number:</p>
                                    <b>+00965 559923031</b>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex justify-content-between">
                                    <p>Fax Number:</p>
                                    <b>+00965 559923031</b>
                                </div>
                            </li>
									
							</ul>
				
					</div>
				</aside>


                <aside class="p-3 bg-white pb-5 mb-5 contact-address-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Address</h4>
					</div>
					<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
                            <li>
                                <p>123 Main Street, New York, NY 10030</p>
                            </li>
                            <li>
                                <p>123 Main Street, New York, NY 10030</p>
                            </li>
							<li>
                                <div class="d-flex justify-content-between">
                                    <p>Country:</p>
                                    <b>United States of America</b>
                                </div>
                            </li>
							<li>
                                <a href="#">
                                <img src="/images/site-images/address-location-cont.svg">
                                https://googlemaplink
                                </a>
                            </li>		
							</ul>
				
					</div>
				</aside>


            <aside class="p-3 bg-white pb-5 mb-5 contact-groups-detail-sec">
					<div class="sidebar-top d-flex justify-content-between align-items-center">
						<h4 class="text-capitalize mb-0">Groups</h4>
					</div>
				<div class="sidebar-inner" id="sidebar-inner">
						<ul class="sidebar-top-list">
                            <li>
                                <p>Group 1</p>
                            </li>
                            <li>
                                <p>Sub Group 1</p>
                            </li>		
							</ul>

                        <div class="tags-btns overflow-auto">
							<h4 class="text-capitalize mt-2 mb-3">tags</h4>
																					

                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">test</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>

                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">test</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>

                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">test</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>

                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">test</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>

                            <div class="tab-buttons">
                                    <button type="button" data-tag-name="test" data-tag-index="0" class="btn btn-success edit-tag">test</button>
                                    <form method="POST" action="https://sanadportal.com/contact-delete-tag" onsubmit="return confirm('Are you sure?');">
                                        <input type="hidden" name="_token" value="oGmBBmfvmRX9NJwJdqVjokujbkfGtwNQc5TPNGTx">                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="116">
                                        <input type="hidden" name="tagName" value="test">
                                        <input type="hidden" name="tagIndex" value="0">
                                        <button type="submit" class="tag-buttons-delete"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                            </div>
                        </div>
                            
				
					</div>
				</aside>


                


        </div>

        </div>
    </div>
</div>

@endsection
