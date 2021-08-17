<div class="inner-new-contact">
  <input type="hidden" name="type" value="{{(isset($type) && $type!="")?$type:''}}" class="company_type" >
  <div class="card-header">
      <h3 class="card-title"> All Contacts</h3>
      <div class="btn-group float-right">
      <form class="form-inline contact-side-bar-search contact-table-search">
            <div class="input-group input-group-sm">
                <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                <div class="input-search-append">
                    <button class="btn" type="submit">
                        <!-- <i class="fas fa-search"></i> -->
                        <img src="/images/site-images/noun_Search_1.svg">
                    </button>
                </div>
            </div>
     </form>
        <div class="input-group-prepend">
            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <i class="fa fa-list mr-1 p-1"></i> -->
                <img src="/images/site-images/view.svg">
                View
            </button>

            <div class="dropdown-menu">

                <a class="toggle-vis dropdown-item" data-column="1">Name</a>
                <a class="toggle-vis dropdown-item" data-column="2">First person</a>
                  <a class="toggle-vis dropdown-item" data-column="3">Second person</a>
                  <a class="toggle-vis dropdown-item" data-column="4">Country</a>
                  <a class="toggle-vis dropdown-item" data-column="5">Tag</a>

                  <a class="toggle-vis dropdown-item" data-column="6">Action</a>


            </div>
            </div>
          <div class="input-group-prepend">
              <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <!-- <i class="fa fa-cog"></i> -->
                  <img src="/images/site-images/options.svg">
                  Options
              </button>

              <div class="dropdown-menu">
                  <a class="dropdown-item option" href="javascript:void(0);" data-type="group" data-id="contacts_table">Add to group</a>
                  <a class="dropdown-item option" href="javascript:void(0);" data-type="tag" data-id="contacts_table">Add Tag</a>
                  @if(!isset($type))
                  <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-merge" data-type="merge" data-id="contacts_table">Merge</a>
                  @endif
                  <a class="dropdown-item option" href="/organisation/{{$org_id}}/contact-archive" data-type="archive" data-id="contacts_table">Archive</a>
                  <form action="{{ route('export.contacts', [$org_id,'all','']) }}" method="GET">
                      <button type="submit" class="dropdown-item" href="/export-contacts" data-id="contacts_table">Export CSV</button>
                  </form>
              </div>



              </div>
              <div class="input-group-prepend">


                  <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="custom-menu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i class="fa fa-filter mr-1"></i> -->
                      <img src="/images/site-images/sort-by.svg">
                      Sort By
                  </button>
                  <input type="hidden" class="org_id" name="org_id" value={{$org_id}}>


                  <div class="dropdown-menu">
                      <a class="dropdown-item " href="javascript:void(0);" data-type="group" data-id="contacts_table"><input type="checkbox" class="filter" name="filter" value="country">Country</a>
                      <a class="dropdown-item " href="javascript:void(0);" data-type="tag" data-id="contacts_table"><input type="checkbox" class="filter" name="filter" value="tag">Tag</a>

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
