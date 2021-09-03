@extends('layouts.app')
<title>Organisation List</title>
@section('content')
<div class="card section-size">
		<div class="card-header py-4">
			<h3 class="card-title">Orgnizations</h3>
			<a class="float-right btn btn-primary common-button-site" href="{{ route('org_create') }}">Add <i class="fa fa-plus ml-1"></i></a>
		</div>
	<!-- /.card-header -->
		<div class="card-body custom-pagination">
			<div class="tabel-scroll-sec">
				<table id="organisation" class="table table-bordered table-striped">
					<thead>

						@if(!$organisations->isEmpty())
						<tr>
							<th>Organisation Name</th>
							<th>Created by</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $organisations as $organisation )
								@if($loop->iteration % 2 == 0)
									<tr class="even">
								@else
									<tr class="odd">
								@endif

											<td><a href="/organisation/view/{{$organisation->id}}">{{ $organisation->org_name }}</a></td>
											<td>{{ (isset($organisation['user_detail']['name']))?$organisation['user_detail']['name']:'' }}</td>
											 <td>{{ $organisation->created_at }}</td>
											<td>
												<div class="dropdown">
														<!--Trigger-->
														<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
														<!--Menu-->
														<div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
															@if (Auth::user()->role=="2")
																	<a href="{{ route('org_edit', $organisation->id) }}" class="dropdown-item">Edit</a>
																	<form class="inline-block" action="{{ route('org_delete')}}" method="POST" onsubmit="return confirm('Are you sure?');">
																			<input type="hidden" name="id" value="{{$organisation->id}}">
																			<input type="hidden" name="_token" value="{{ csrf_token() }}">
																			<input type="submit" class="dropdown-item" value="Delete">
																	</form>
															@else
															<a href="{{route('org_view',$organisation->id)}}" class="dropdown-item">View</a>

															@endif
														</div>
												</div>
											</td>
								</tr>
						@endforeach
					</tbody>
					@else
					<h1 class="text-center">No organisation exist</h1>
					@endif
				</table>
			</div>
		</div>
</div>
@endsection
