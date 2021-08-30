<div class="sidebar-icon">
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </div>
<aside class="bg-white contact-side-bar">
    <div class="sidebar-menu">
    <form class="form-inline contact-side-bar-search">
        <div class="input-group input-group-sm">
            <input class="form-control " type="search" placeholder="Search" aria-label="Search">
            <div class="input-search-append">
                <button class="btn" type="submit">
                    <!-- <i class="fas fa-search"></i> -->
                    <img src="/images/site-images/search-shape.svg">
                </button>
            </div>
        </div>
    </form>
        <ul class="side-bar-list">
            <li class="sidebar-dropdown new-contact-btns">
                <a class="all-contacts" href="{{ route('contact.index',[$org_id]) }}">
                    <span>All Contacts</span>
                </a>
                    <ul>
                        <li class="sidebar-dropdown new-contact-btns">
                          <a href="{{ route('contact.supplier',[$org_id,'customer']) }}">
                        <img src="/images/site-images/customers.svg">
                        Customers</li></a>
                        <li class="sidebar-dropdown new-contact-btns">
                      <a href="{{ route('contact.supplier',[$org_id,'supplier']) }}">  <img src="/images/site-images/supplier.svg">
                        Suppliers</li>
                        <li class="sidebar-dropdown new-contact-btns"><a href="{{ route('contact.employee',[$org_id]) }}">
                        <img src="/images/site-images/employees.svg">
                        Employees</a></li>
                        <li class="sidebar-dropdown new-contact-btns">
                           <img src="/images/site-images/archive.svg">
                            <a href="{{ route('contact.archive',[$org_id]) }}">
                            <span class="">Archive</span>
                            </a>

                        </li>
                    </ul>
            </li>

                <!-- <a href="{{ route('contact.create',[$org_id]) }}">
                    <span class="badge badge-pill badge-danger">New</span>
                </a> -->


            </li>

            <li class="new-contact-btns new-gp-sliderbar  add-gps-sidebar">
                <div class="add-gp-side-bar">
                    <a href="{{ route('organisation.group',[$org_id]) }}">
                        <span>All Groups</span>
                    </a>

                    <button type="button" class="badge badge-pill badge-danger" data-toggle="modal" data-target="#modal-default">
                        Add New
                    </button>
                </div>

                <ul>
                    @if(!empty($groups))

                    @foreach($groups as $group)

                    @if(isset($group->subgroup) && !($group->subgroup->isEmpty()))

                      <li class="groups-side-bar">

                          <div class="panel-group" id="accordion{{$group->id}}" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="heading0">
                                  <h3 class="panel-title">
                                  <a class="collapsed gp-link" role="button" title="" data-toggle="collapse" data-parent="#accordion{{$group->id}}" href="#collapse{{$group->id}}" aria-expanded="false" aria-controls="collapse{{$group->id}}">
                                      {{$group->title}}
                                  </a>
                                  </h3>
                              </div>
                              <div id="collapse{{$group->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading0" style="">
                                  <div class="panel-body">
                                  <ul>

                                    @if(!empty($group->subgroup))
                                    @foreach($group->subgroup as $subgroup)
                                    <?php //print_R($subgroup); ?>
                                      <li><a href="{{route('organisation.group.contact.list',[$org_id,$subgroup['id']])}}">{{$subgroup['title']}}</a></li>
                                      @endforeach
                                      @endif

                                  </ul>
                                  </div>
                              </div>
                              </div>
                          </div>

                      </li>
                      @else

                      <li class="groups-side-bar">

                          <div class="panel-group" id="accordion{{$group->id}}" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="heading0">
                                  <h3 class="panel-title">
                                  <a class="collapsed gp-link " role="button" title="" data-toggle="collapse" data-parent="#accordion{{$group->id}}" href="#collapse0" aria-expanded="false" aria-controls="collapse0">
                                      {{$group->title}}
                                  </a>
                                  </h3>
                              </div>
                            </li>
                      @endif

                @endforeach
                @endif

                  
                  </ul>


            </li>

        </ul>
    </div>
    <!-- sidebar-menu  -->
</aside>

<script>
$(document).ready(function(){
  $(".gp-link").click(function(){
    //$(".groups-side-bar").toggleClass("groups-side-bar-active ");
    $(this).closest('.groups-side-bar').toggleClass("groups-side-bar-active ");
  });
});

$(document).ready(function(){
  $(".sidebar-icon").click(function(){
    $(".common-sidebar-sec").toggleClass("active-sidebar");
    $(".contact-list-sec").toggleClass("active-contact-list-sec");
    $(".master_section-sec").toggleClass("active-master_section-sec");
  });
});

</script>

<!-- https://www.solodev.com/blog/web-design/how-to-use-bootstrap-accordions-to-organize-faq-pages.stml -->
