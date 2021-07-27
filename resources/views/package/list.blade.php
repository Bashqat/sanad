@extends('layouts.app')
<title>Organisation List</title>
@section('content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Package</h3>
			<a class="float-right btn btn-primary common-button-site" href="{{ route('package.create') }}">Add new Package <i class="fa fa-plus ml-1"></i></a>
		</div>
	<!-- /.card-header -->
		<div class="card-body">
			<div class="tabel-scroll-sec">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Name</th>
              <th>Price</th>
							<th>No of organisation limit</th>
							<th>Number of user limit</th>
              <th>Number of contact limit</th>
              <th>Third Party api</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $packages as $package )
								@if($loop->iteration % 2 == 0)
									<tr class="even">
								@else
									<tr class="odd">
								@endif
											<td>{{ $package->name }}</td>
                      <td>{{ $package->price }}</td>
											<td>{{ $package->storage_per_org }}</td>
											 <td>{{ $package->invite_user_count }}</td>
                       <td>{{ $package->contact_count }}</td>

                       <td>{{ ($package->third_party_api!='null')?$package->third_party_api:'' }}</td>

											<td>
												<div class="dropdown">
														<!--Trigger-->
														<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
														<!--Menu-->
														<div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
															@if (Auth::user()->role=="1")
																	<a href="{{ route('package.create', $package->id) }}" class="dropdown-item">Edit</a>
																	<form class="inline-block" action="{{ route('package.delete')}}" method="POST" onsubmit="return confirm('Are you sure?');">
																			<input type="hidden" name="package_id" value="{{$package->id}}">
																			<input type="hidden" name="_token" value="{{ csrf_token() }}">
																			<input type="submit" class="dropdown-item" value="Delete">
																	</form>
															@else
															<a href="" class="dropdown-item">View</a>

															@endif
														</div>
												</div>
											</td>
								</tr>
						@endforeach
						</tfoot>
				</table>
			</div>
		</div>
</div>
@endsection
