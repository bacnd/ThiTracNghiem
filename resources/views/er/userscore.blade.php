@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
        <div class="heading heading-white">
            <h1><i class="glyphicon glyphicon-repeat"></i> Bảng xếp hạng</h1>
            <hr>
        </div>
@if(count($userscores)>0)
        <!-- Striped table -->
		<div class="pmd-card pmd-z-depth">
			 <div class="table-responsive">
		     	<!-- Table -->
		        <table class="table pmd-table table-striped table-mc-red table-hover">
		          <thead>
		          	<tr>
		              <th>Hạng</th>
		              <th>User</th>
		              <th>Điểm</th>
		            </tr>
		          </thead>
		          <tbody>
				@foreach($userscores as $key => $us)
		            <tr>
		            	<td data-title="rank">{{ $key+1 }}</td>
		            	<td data-title="Name">{{ $users->find($us[0]->user_id)->name }}</td>
	              		<td data-title="point">{{ $us[0]->point }}</td>
		            </tr>
				@endforeach
	        		</tbody>
		        </table>
			</div>
			<div class="pull-right">

			</div>
@else
Chua co xep hang
@endif
		</div>
    </div>
</div>
@endsection