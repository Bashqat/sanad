<div class="inner-new-contact">
  <input type="hidden" name="type" value="{{(isset($type) && $type!="")?$type:''}}" class="company_type" >
  <div class="card-header d-flex">
      <h3 class="card-title w-100"> All Contacts</h3>
      <div class="btn-group float-right">
      <!-- <form class="form-inline contact-side-bar-search contact-table-search">
            <div class="input-group input-group-sm">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <div class="input-search-append">
                    <button class="btn" type="submit">

                        <img src="/images/site-images/noun_Search_1.svg">
                    </button>
                </div>
            </div>
     </form> -->
    <div class="contact-header-dropdowns d-flex">
        <div class="input-group-prepend sort-by-dropdown contact-view-options d-flex align-items-center">
            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <i class="fa fa-list mr-1 p-1"></i> -->
                <img class="drop-filter-icon" src="/images/site-images/view.svg">
                <img class="blue-drop-filter-icon" src="/images/site-images/blue-view-icon.svg">
                View
            </button>

            <div class="dropdown-menu">
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="1">
                <a class=" dropdown-item" data-column="1">Name</a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="2">
                <a class=" dropdown-item" data-column="2">First person </a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="3">
                <a class=" dropdown-item" data-column="3">Second person</a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="4">
                <a class=" dropdown-item" data-column="4">Country</a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="5">
                <a class=" dropdown-item" data-column="5">Tag</a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>
            <div class="contact-options d-flex align-items-center">
                <input type="checkbox" class="filter contact-custom-check" name="filter" value="6">
                <a class=" dropdown-item" data-column="6">Action</a>
                <img src="/images/site-images/drop-view-icon.svg">
            </div>

            <div class="dropdown-footer-btns d-flex align-items-center justify-content-between">
                <button class="btn dropdown-cancel-btn">Reset</button>
                <button class="btn dropdown-save-btn toggle-vis">Apply</button>
            </div>



            </div>
            </div>
          <div class="input-group-prepend d-flex align-items-center contact-view-options contact-list-options">
              <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <!-- <i class="fa fa-cog"></i> -->
                  <img class="drop-filter-icon" src="/images/site-images/options.svg">
                  <img class="blue-drop-filter-icon" src="/images/site-images/blue-options.svg">
                  Options
              </button>

              <div class="dropdown-menu dropdown-menu-right">
                          <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio radio_option" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-type="group" data-id="contacts_table">
                            <a class="dropdown-item option" href="javascript:void(0);" data-type="group" data-id="contacts_table">Add to group</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio radio_option" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-type="tag" data-id="contacts_table">
                            <a class="dropdown-item option" href="javascript:void(0);" data-type="tag" data-id="contacts_table">Add Tag</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio radio_option" type="radio" name="flexRadioDefault" id="flexRadioDefault1" data-type="merge" data-id="contacts_table">
                            <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-merge" data-type="merge" data-id="contacts_table">Merge</a>
                            </div>

                            <div class="contact-options d-flex align-items-center">
                            <input class="contact-custom-radio radio_option" type="radio" name="flexRadioDefault" id="flexRadioDefault1" href="/organisation/{{$org_id}}/contact-archive" data-type="archive" data-id="contacts_table">
                            <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-archive" data-type="archive" data-id="contacts_table">Archive</a>
                            </div>



                            <div class="contact-options d-flex align-items-center">
                                <form action="{{ route('export.contacts', [$org_id,'all','']) }}" method="GET">
                                    <button type="submit" class="dropdown-item" href="/export-contacts" data-id="contacts_table">Export CSV</button>
                                </form>
                            </div>

                  <div class="dropdown-footer-btns d-flex align-items-center justify-content-between">
                                <button class="btn dropdown-cancel-btn">Cancel</button>
                                <button class="btn dropdown-save-btn option_action">Save</button>
                            </div>

              </div>



              </div>
              <div class="input-group-prepend sort-by-dropdown contact-view-options d-flex align-items-center">


                  <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i class="fa fa-filter mr-1"></i> -->
                      <img class="drop-filter-icon"  src="/images/site-images/sort-by.svg">
                      <img class="blue-drop-filter-icon"  src="/images/site-images/bule-sort-by.svg">
                      Sort By
                  </button>
                  <input type="hidden" class="org_id" name="org_id" value={{$org_id}}>


                  <div class="dropdown-menu">
                  <div class="contact-options d-flex align-items-center">
                             <input type="checkbox" class="filter contact-custom-check" name="filter" value="country">
                            <a class="dropdown-item sort_filter_option" href="javascript:void(0);" data-type="country" >Country</a>
                            </div>
                            <!-- <input type="checkbox" class="filter" name="filter" value="country"> -->

                            <div class="contact-options d-flex align-items-center">
                            <input type="checkbox" class="filter contact-custom-check sort_filter_option" name="filter" value="tag">
                            <a class="dropdown-item " href="javascript:void(0);" data-type="tag" data-id="contacts_table">Tag</a>
                            </div>

                            <div class="dropdown-footer-btns d-flex align-items-center justify-content-between">
                                <button class="btn dropdown-cancel-btn">Reset</button>
                                <button class="btn dropdown-save-btn sort_filter">Apply</button>
                            </div>
                        </div>
                      </div>

              <a href="{{ route('contact.create',[$org_id]) }}">
                <button class="btn add-new-contact common-button-site float-right">
                    <!-- <i class="fa fa-plus"></i> -->
                    <img src="/images/site-images/pluse.svg">
                     Add New Contact  </button>
              </a>
      </div>

          </div>
      </div>
  </div>
