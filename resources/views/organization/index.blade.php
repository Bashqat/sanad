@extends('layouts.app')

@section('content')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Orgnizations</h3>
		<a class="float-right btn btn-primary common-button-site" href="{{ route('organization.create') }}">Add <i class="fa fa-plus ml-1"></i></a>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="tabel-scroll-sec">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Legal name</th>
						<th>Type of organization</th>
						<th>Type of business</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $organizations as $organization )
					@if($loop->iteration % 2 == 0)
					<tr class="even">
						@else
					<tr class="odd">
						@endif
						<td>{{ $organization->display_name }}</td>
						<td>{{ $organization->legal_name }}</td>
						<td>{{ $organizationTypes[$organization->type_of_organization] }}</td>
						<td>{{ $businessTypes[$organization->type_of_business] }}</td>
						<td>
							<div class="dropdown">
								<!--Trigger-->
								<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
								<!--Menu-->
								<div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">
									<a href="{{ route('organization.edit', $organization->id) }}" class="dropdown-item">Edit</a>
									<form class="inline-block" action="{{ route('organization.destroy', $organization->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
										<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="submit" class="dropdown-item" value="Delete">
									</form>
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
