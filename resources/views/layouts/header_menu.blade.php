<!-- Main Header -->
<?php
		Config::set("database.connections.mysql", [
							'driver' => 'mysql',
							"host" => "127.0.0.1",
							"database" => getenv("DB_DATABASE"),
							"username" => "root",
							"password" => getenv("DB_PASSWORD"),
							'charset' => 'utf8',
							'prefix' => '',
							'prefix_indexes' => true,
							'schema' => 'public',
							'sslmode' => 'prefer',
			]);
					DB::purge('mysql');
					//$org_list = array();
					$org_list= \App\Models\MasterOrganisation::get();
					if(Auth::user()->role!=1)
					{
						$org_list= \App\Models\MasterOrganisation::where('superadmin_id',Auth::id())->get();
					}
					$actual_link = $_SERVER['REQUEST_URI'];
					$org_id=substr($actual_link, strrpos($actual_link, '/') + 1);

					if (strpos($actual_link, 'organisation/') !== false   ) {
						if(strpos($actual_link, 'organisation/create') == true)
						{

						}else {
							preg_match_all('!\d+!', $actual_link, $matches);

							$org_id=$matches[0][0];
						}
						//echo $org_id;

						}



 ?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light py-0">
				<nav class="navbar navbar-expand-md toggle-navbar-sec p-0">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
									<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse" id="collapsibleNavbar">
								<ul class="navbar-nav">
													<li class="nav-item d-none">
														<div class="nav-item dropdown company-menu">
															<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
																<span class="dropdown-item dropdown-header text-left">
																	<img src="{{url('/images/site-logo.png')}}" alt="AdminLTE Logo" class="brand-image">
																</span>
															</div>
														</div>
													</li>


													<div class="nav-item dropdown company-menu show">
														<a class="nav-link mr-md-2 ml-2 px-5" data-toggle="dropdown" href="#" aria-expanded="true">

																@if((empty($org_list)) && !preg_match('#[0-9]#',$org_id))
																		  No Organisation exist
																@elseif(!empty($org_list) && Auth::user()->role==1 )
																				Select
																@elseif(Auth::user()->role==2 && isset($org_list[0]) && !empty($org_list[0]) && !preg_match('#[0-9]#',$org_id))
																			{{$org_list[0]->org_name}}
																@endif
																@foreach ( $org_list as $list )
																		@if($org_id==$list->id)
																			{{$list->org_name}}
																		@endif
																@endforeach
																<!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->
																<img src="/images/site-images/arrow-right.svg">
														</a>

												<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right org-menu" >

													 @if(!empty($org_list) && Auth::user()->role!=1)
													 		@foreach ( $org_list as $key=>$list )
															@if($key<2)
															 <div class="org-name-nav-item">
																 @if($list->logo!="")
																 <img  class="header_logo" src="{{ url('/organisation_logo') }}/{{$list->logo}}">
																 @else
																 <img src="/images/site-images/org-logo.svg">
																 @endif

															 <a href="/organisation/view/{{$list->id}}" class="dropdown-item">
																			{{$list->org_name}}
																	</a>
															</div>

																@if (strpos($actual_link, 'organisation/') !== false && preg_match('#[0-9]#',$actual_link))
																			@if($org_id==$list->id)
																						<li class="dropdown-submenu ">
																								<a class="dropdown-item" href="#">Files</a></li>
																						</li>
																						<li class="dropdown-submenu ">
																									<a class="dropdown-item dropdown-toggle" href="#">Setting</a>
																									<ul class="dropdown-menu header-submenu">
																									<div class="header-submenu-triangle"></div>
																									        <!-- <li><a class="dropdown-item triangle" href="/organisation/{{ $org_id }}/user-management">User</a></li> -->
																											<li><a class="dropdown-item" href="/organisation/{{ $org_id }}/user-management">User Management</a></li>
																											<li><a class="dropdown-item" href="/organisation/{{ $org_id }}/smtp">Email Setting</a></li>
																											<li><a class="dropdown-item" href="/organisation/{{ $org_id }}/contact">Contact</a></li>
																											<li><a class="dropdown-item" href="/organisation/{{$org_id}}/security">Security</a></li>
																											<li><a class="dropdown-item" href="#">Account setting</a></li>
																											<li><a class="dropdown-item" href="#">Template Setting</a></li>
																											<li><a class="dropdown-item" href="{{route('organisation.app',$org_id)}}">App Connection</a></li>
																									</ul>
																							</li>

																				@endif

																@elseif($key==0)
																<li class="dropdown-submenu ">
																		<a class="dropdown-item" href="#">Files</a></li>
																</li>
																<li class="dropdown-submenu ">
																			<a class="dropdown-item dropdown-toggle" href="#">Setting</a>
																			<ul class="dropdown-menu header-submenu">
																			<div class="header-submenu-triangle"></div>
																		         	<!-- <li><a class="dropdown-item triangle" href="/organisation/{{ $org_id }}/user-management">User </a></li> -->
																					<li><a class="dropdown-item" href="/organisation/{{ $org_list[0]->id}}/user-management">User Management</a></li>
																					<li><a class="dropdown-item" href="/organisation/{{ $org_list[0]->id }}/smtp">Email Setting</a></li>
																					<li><a class="dropdown-item" href="/organisation/{{ $org_list[0]->id }}/contact">Contact</a></li>
																					<li><a class="dropdown-item" href="/organisation/{{$org_list[0]->id}}/security">Security</a></li>
																					<li><a class="dropdown-item" href="href="/profile/{{Auth::user()->id}}/edit"">Account setting</a></li>
																					<!-- <li><a class="dropdown-item" href="#">Template Setting</a></li> -->
																					<li><a class="dropdown-item" href="{{route('organisation.app',$org_list[0]->id)}}">App Connection</a></li>
																			</ul>
																	</li>
																@endif
																<hr>
																@endif

														@endforeach
											@endif
											@if (Auth::user()->role=="1")
												<a href="{{ route('master_setting') }}" class="dropdown-item">
														{{ __('language.setting') }}
												</a>
												<a href="{{ route('package.list') }}" class="dropdown-item">
														{{ __('language.package') }}
												</a>

											@else
												<a href="{{ route('setting') }}" class="dropdown-item">
														{{ __('language.super_admin_setting') }}
												</a>
											@endif
											<a href="/organisation" class="dropdown-item">
														<span>Organisation List</span>
											</a>
											<a href="{{ route('org_create') }}" class="dropdown-item">
														<i class="fa fa-plus"></i>
														<span>Add Organization</span>
											</a>


											@if (strpos($actual_link, 'organisation/') !== false && preg_match('#[0-9]#',$actual_link))

												<!-- <a href="/organisation/{{ $org_id }}/user-management" class="dropdown-item">{{__('language.user_management') }}</a> -->
											@else
														<a href="{{ route('subscription.list') }}" class="dropdown-item">
																			<span>Subscription and billing</span>
														</a>
														<a href="{{ route('users-management.index') }}" class="dropdown-item">
																			<span>User management</span>
														</a>
									    @endif

									</div>
							</div>
							<li class="nav-item">

									<a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">{{ __('language.dashboard') }}</a>
							</li>
					</ul>

				</div>
		</nav>
						<ul class="navbar-nav ml-auto">
							<form class="form-inline header-search mb-0">
								<div class="input-group input-group-sm">
									<input class="form-control form-control-navbar" type="search" placeholder="{{ __('language.search') }}" aria-label="Search">
									<div class="input-group-append">
										<button class="btn btn-navbar d-flex align-items-center" type="submit">
											<!-- <i class="fas fa-search"></i> -->
											<img src="/images/site-images/noun_search.svg">
										</button>
									</div>
								</div>
							</form>
							<li class="nav-item dropdown question-icon-header">
								<a class="nav-link text-white" data-toggle="dropdown" href="#" aria-expanded="false">
									<!-- <i class="far fa-question-circle"></i> -->
									<img src="/images/site-images/grid_round.svg">
								</a>
								<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<a href="#" class="dropdown-item">
										<span>Help Center</span>
									</a>
									<a href="#" class="dropdown-item">
										<span>Submit Support Ticket</span>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link text-white d-flex align-items-center" data-toggle="dropdown" href="#" aria-expanded="false">
									<!-- <i class="far fa-bell"></i> -->
									<img src="/images/site-images/alarm.svg">
									<span class="badge badge-warning navbar-badge d-none">15</span>
								</a>
								<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
									<span class="dropdown-item dropdown-header">15 Notifications</span>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item">
										<i class="fas fa-envelope mr-2"></i> 4 new messages
										<span class="float-right text-muted text-sm">3 mins</span>
									</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item">
										<i class="fas fa-users mr-2"></i> 8 friend requests
										<span class="float-right text-muted text-sm">12 hours</span>
									</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item">
										<i class="fas fa-file mr-2"></i> 3 new reports
										<span class="float-right text-muted text-sm">2 days</span>
									</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
								</div>
							</li>
							</li>
							<div class="nav-item dropdown user-menu user-profile-name super-admin">
								<a href="#" class="nav-link mr-md-1 dropdown-toggle user-circle-img d-flex align-items-center" data-toggle="dropdown">
									<img src="@if (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Auth::user()->avatar }}@else/images/profile/{{ Auth::user()->avatar }}@endif" class="user-image img-circle elevation-2" alt="User Image">
									<p>{{ ucfirst(Auth::user()->name) }}</p>
									<span class="d-md-inline">
										<!-- {{ Auth::user()->name }} -->
										<!-- <i class="fas fa-sort-down"></i> -->
										<!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->
										<img src="/images/site-images/path.svg">
									</span>
								</a>
								<ul class="dropdown-menu dropdown-menu-sm w-auto dropdown-menu-right super-admin">
									<!-- Menu Footer-->
									<a class="dropdown-item">
										<img src="@if (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Auth::user()->avatar }}@else/images/profile/{{ Auth::user()->avatar }}@endif" class="user-image img-circle elevation-2" alt="User Image"><span>{{ ucfirst(Auth::user()->name) }}</span>
									</a>
									<a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit">
										<img src="/images/site-images/edit-profile.svg"><span>{{ __('language.edit') }}</span>
									</a>


									<a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										<img src="/images/site-images/logout-profile.svg"><span>{{ __('language.signout') }}</span>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</a>
								</ul>
							</div>
						</ul>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){

		$(':checkbox').append('<label for=""></label>');
		$(".org_setting").click(function () {

        $("li", this).toggle();
				// $('.company-menu').addClass('show');
				// $('.org-menu').addClass('show');

    });

		// $('a.dropdown-item').click(function(){
		// 	$('.dropdown-menu').addClass('show');
		// });
  })
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
	    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
	  }
	  var $subMenu = $(this).next('.dropdown-menu');
	  $subMenu.toggleClass('show');
	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	    $('.dropdown-submenu .show').removeClass('show');
	  });
	  return false;
	});
</script>
