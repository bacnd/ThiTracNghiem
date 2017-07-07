@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row animated fadeInDown">
        <div class="heading heading-white">
            <h1><i class="glyphicon glyphicon-repeat"></i> Lịch sử làm bài</h1>
            <hr>
        </div>

        <!-- Striped table -->
		<div class="pmd-card pmd-z-depth">
			 <div class="table-responsive">
		     	<!-- Table -->
		        <table class="table pmd-table table-striped table-mc-red table-hover">
		          <thead>
		          	<tr>
		              <th>Bài thi</th>
		              <th>Thời gian làm</th>
		              <th>Điểm</th>
		            </tr>
		          </thead>
		          <tbody>
		          @foreach($examresults as $er)
		            <tr>
		            	<td data-title="title"><a href="{{ route('posts.show', $er->post_id) }}"><strong>{{ $posts->find($er->post_id)->title }}</strong></a></td>
		              <td data-title="time">{{ $er->time }}</td>
		              <td data-title="point">{{ $er->point }}</td>
		            </tr>
	            	@endforeach
	        		</tbody>
		        </table>
			</div>
			<div class="pull-right">
				{{ $examresults->links() }}
			</div>
		</div>
    </div>
</div>
@endsection