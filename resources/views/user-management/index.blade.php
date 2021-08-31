@extends('layouts.app')
<title>Sanad | User management</title>
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

<div class="card">
	<div class="card-header user-mang-filter">
		<h3 class="card-title">{{ ucfirst( str_replace("-"," ", Request::segment(1)) ) }}</h3>
		@if(!isset($org_id))
		{{$org_id=''}}
		@endif

                <a href="{{ route('org-users-management.invite', $org_id ?? '') }}" class="float-right btn btn-primary common-button-site user-filter-btn {{ ($org_id=="")?'disabled': ''}}">{{ __('language.invite_user') }} <i class="fa fa-plus ml-1"></i></a>
		<!-- @hasrole('super-admin') -->
		<!-- <form id="filter" method="get">
            <select class="float-right form-control select2 col-lg-1 col-md-2 col-sm-2 mr-1" name="role" onchange="change()">
                <option value="user" {{ ($role == 'user')? "selected":"" }}>user</option>
                <option value="admin" {{ ($role == 'admin')? "selected":"" }}>admin</option>
			</select>
		</form>
		<label class="float-right mr-1 mt-2 mb-2">User Filter</label> -->
		<!-- @endhasrole -->
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="tabel-scroll-sec table-user-mang">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><input type="checkbox" name="checkbox" class="select-all"></th>
						<th>User</th>
						<th>Status</th>
						<!-- <th>Role</th> -->
						<th>Email</th>
						<!-- <th>Access</th> -->

						<th>Action</th>

					</tr>
				</thead>
				<tbody>
                    @forelse ( $users as $user )
                        @if($loop->iteration % 2 == 0)
                        <tr class="even">
                        @else
                        <tr class="odd">
                        @endif
                            <td><input type="checkbox" class="row-select" data-id="{{ $user->id }}"></td>
                            <td>
                                <a href="">{{ $user->name }}</a>
                            </td>
                            <td>
                                @if($user->status !='active' )
                                <button class="btn btn-warning">{{ucfirst(str_replace("_"," ",$user->status))}}</button>
                                @else
                                <button class="btn btn-success">{{ucfirst(str_replace("_"," ",$user->status))}}</button>
                                @endif
                            </td>

                            <td>{{ $user->email }}</td>
                            <!-- <td>
                                <p>{{ ( $user->can('view edit contact') ) ? "view edit contact":"" }}</p>
                                <p>{{ ( $user->can('view contact') ) ? "view contact":"" }}</p>
                                <p>{{ ( $user->can('view password') ) ? "view password":"" }}</p>
                            </td> -->
                            <!-- @hasanyrole('super-admin|admin') -->
                                <td>
                                    <div class="dropdown">
                                        <!--Trigger-->
                                        <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
                                        <!--Menu-->
                                        <div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
																					@if(isset($org_id) && $org_id!="")
																					<a class="dropdown-item" href="{{ route('org-users-management.edit', [$org_id,$user->id]) }}">Edit</a>
																					@else
																					<a class="dropdown-item" href="{{ route('users-management.edit', $user->id) }}">Edit</a>
																					<a class="dropdown-item" href="{{ route('subscription.user.view', $user->id) }}">View</a>
																					@endif

																						@if(isset($org_id) && $org_id!="")
                                            <form class="inline-block" action="{{ route('org-users-management.delete', [$org_id,$user->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
																							@else
																							<form class="inline-block" action="{{ route('users-management.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
																							@endif
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="dropdown-item" value="Delete">
                                            </form>
																						@if(isset($org_id) && $org_id!="")
																						<form class="inline-block" action="{{ route('org-users-management.change-status', [$org_id,$user->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');">
																							<input type="hidden" name="_token" value="{{ csrf_token() }}">
																							@if($user->status=='active')
																							<input type="submit" class="dropdown-item" value="Suspend">
																							@elseif($user->status=='suspended')
																							<input type="submit" class="dropdown-item" value="Active">
																							@endif
																					</form>
																					@endif
                                            @if($role == 'user')
                                            <a class="dropdown-item" href="/auth-update-view/{{$user->id}}">Manage Authority</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            <!-- @endhasanyrole -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No User Found</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <form>
                            <td>
                                @if(count($users))
																@if(isset($org_id) && $org_id!="")
																<input type="hidden" value="org_selected" id="org_select_status">
																<input type="hidden" value="{{$org_id}}" id="org_id">
																@else
																<input type="hidden" value="0" id="org_id">
																<input type="hidden" value="org_not_selected" id="org_select_status">
																@endif

                                    <button type="button" class="btn btn-danger " id="delete_all">Delete</button>

                                @endif
                            </td>
                            <td colspan="6">
                            </td>
                        </form>
                    </tr>
                </tfoot>
			</table>

		</div>
	</div>
</div>
<script>

	function change() {
		document.getElementById("filter").submit();
	}

</script>
@endsection
