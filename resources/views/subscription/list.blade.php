@extends('layouts.app')
<title>Sanad | Subscription List</title>
@section('content')
<div class="card">
		<div class="card-header">
			<h3 class="card-title">Subscription</h3>
			<!-- <a class="float-right btn btn-primary common-button-site" href="{{ route('package.create') }}">Add new Package <i class="fa fa-plus ml-1"></i></a> -->
		</div>
	<!-- /.card-header -->
		<div class="card-body">
			<div class="tabel-scroll-sec">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>User Name</th>
              <th>Package Name</th>
							<th>Start Date</th>
							<th>End Date</th>
              <th>Price</th>
              <th>Paid via</th>
              <th>Transaction id</th>
                <th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@if($subscriptions->isEmpty())
						@foreach ( $subscriptions as $subscription )
								@if($loop->iteration % 2 == 0)
									<tr class="even">
								@else
									<tr class="odd">
								@endif
											<td>{{ $subscription->user_detail['name'] }}</td>
											<td>{{ $subscription->package['name']  }}</td>
											 <td>{{ $subscription->start_date }}</td>
                       <td>{{ $subscription->end_date }}</td>
                       <td>{{ $subscription->package_price }}</td>
                       <td>{{ $subscription->paid_via }}</td>
                       <td>{{ $subscription->payment_transaction_id }}</td>
                      <td>{{ $subscription->status }}</td>


											<td>
												<div class="dropdown">
														<!--Trigger-->
														<a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fas fa-ellipsis-v"></i></a>
														<!--Menu-->
														<div class="dropdown-menu dropdown-primary" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 21px, 0px);">

																	<!-- <a href="{{ route('package.create', $subscription->id) }}" class="dropdown-item">Edit</a> -->
																	<form class="inline-block" action="{{ route('subscription.status',$subscription->id)}}" method="POST" onsubmit="return confirm('Are you sure?');">
																			<input type="hidden" name="subscription_id" value="{{$subscription->id}}">
																			<input type="hidden" name="_token" value="{{ csrf_token() }}">
																			<input type="submit" class="dropdown-item" value="{{ ($subscription->status=='active') ? 'Deactivate' : 'Activate'}}">
																	</form>

															<a href="{{ route('subscription.view', $subscription->id) }}" class="dropdown-item">View</a>


														</div>
												</div>
											</td>
								</tr>
						@endforeach
						@else
						<tr><td></td><td></td> <td></td><td><h1 class="text-center">No Data found</h1></td></tr>
						@endif
						</tfoot>
				</table>
			</div>
		</div>
</div>
@endsection
