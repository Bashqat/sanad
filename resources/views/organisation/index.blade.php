@extends('layouts.app')
<title>Organisation List</title>
@section('content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Orgnizations</h3>
			<a class="float-right btn btn-primary common-button-site" href="{{ route('org_create') }}">Add <i class="fa fa-plus ml-1"></i></a>
		</div>
	<!-- /.card-header -->
		<div class="card-body">
			<div class="tabel-scroll-sec">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
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
								<?php echo '<pre>';print_r($organisation); ?>
										
											<td>
												<div class="dropdown">
														<!--Trigger-->
														<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
														<!--Menu-->
														<div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
															@if (Auth::user()->role=="2")
																	<a href="{{ route('org_edit', $organization->id) }}" class="dropdown-item">Edit</a>
																	<form class="inline-block" action="{{ route('org_delete')}}" method="POST" onsubmit="return confirm('Are you sure?');">
																			<input type="hidden" name="id" value="{{$organization->id}}">
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
						</tfoot>
				</table>
			</div>
		</div>
</div>
@endsection
