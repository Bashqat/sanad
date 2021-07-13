<!-- Main Header -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light py-0">
	<nav class="navbar navbar-expand-md toggle-navbar-sec p-0">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
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
											{{ __('language.organisation') }}
                                				<i class="fas fa-sort-down ml-3"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right " style="left: inherit; right: 0px;">
							<?php 
								Config::set("database.connections.mysql", [
								            'driver' => 'mysql',
								            "host" => "localhost",
								            "database" => env('DB_DATABASE'),
								            "username" => "root",
								            "password" => env('DB_PASSWORD'),
								            'charset' => 'utf8',
								            'prefix' => '',
								            'prefix_indexes' => true,
								            'schema' => 'public',
								            'sslmode' => 'prefer',
								        ]);
								DB::purge('mysql');

							$org_list= \App\Models\MasterOrganisation::where('superadmin_id',Auth::id())->get();
							 ?>
							 @if(!empty($org_list))

							@foreach ( $org_list as $list )
							<a href="/organisation/edit/{{$list->id}}" class="dropdown-item">
								{{$list->org_db_name}}
								</a>
							@endforeach
							@endif
							@if (Auth::user()->role=="1")
								<a href="{{ route('master_setting') }}" class="dropdown-item">
								{{ __('language.setting') }}
								</a>
							@else
								<a href="{{ route('setting') }}" class="dropdown-item">
								{{ __('language.setting') }}
								</a>
							@endif
							<a href="{{ route('org_create') }}" class="dropdown-item">
								<i class="fa fa-plus"></i>
								<span>Add Organization</span>
							</a>

							
						</div>
				</div>
					<li class="nav-item">
					
					<a href="{{ route('home') }}" class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}">{{ __('language.dashboard') }}</a>
				</li>
               
			</ul>
			
		</div>
	</nav>
	<ul class="navbar-nav ml-auto">
		<form class="form-inline header-search ml-3 mb-0">
			<div class="input-group input-group-sm">
				<input class="form-control form-control-navbar" type="search" placeholder="{{ __('language.search') }}" aria-label="Search">
				<div class="input-group-append">
					<button class="btn btn-navbar" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
		</form>
		<li class="nav-item dropdown">
			<a class="nav-link text-white d-flex align-items-center" data-toggle="dropdown" href="#" aria-expanded="false">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
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
		<li class="nav-item dropdown question-icon-header">
			<a class="nav-link text-white" data-toggle="dropdown" href="#" aria-expanded="false">
				<i class="far fa-question-circle"></i>
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
		</li>
		<div class="nav-item dropdown user-menu super-admin">
			<a href="#" class="nav-link mr-md-1 dropdown-toggle user-circle-img" data-toggle="dropdown">
				<img src="@if (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL)){{ Auth::user()->avatar }}@else/images/profile/{{ Auth::user()->avatar }}@endif" class="user-image img-circle elevation-2" alt="User Image">
				<span class="d-none d-md-inline">
					<!-- {{ Auth::user()->name }} --><i class="fas fa-sort-down"></i>
				</span>
			</a>
			<ul class="dropdown-menu dropdown-menu-sm w-auto dropdown-menu-right super-admin">
				<!-- Menu Footer-->
				<a class="dropdown-item">
					<span>{{ ucfirst(Auth::user()->name) }}</span>
				</a>
					
				
				<a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<span>{{ __('language.signout') }}</span>
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
		$(':checkbox').append('<label for=""></label>')
    })
</script>
