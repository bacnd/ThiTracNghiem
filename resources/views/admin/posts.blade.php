@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách bài viết</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><span class="fa fa-files-o fa-fw" aria-hidden="true"></span> Bài viết</h3>
        </div>
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th class="text-center">Title</th>
              <th class="text-center">File</th>
              <th class="text-center">Time</th>
              <th class="text-center">Total</th>
              <th class="text-center">User</th>
              <th class="text-center">Create date</th>
            </tr>
          </thead>
          <tbody>
          @foreach($posts as $post)
            <tr>
              <td class="text-center"><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
              <td class="text-center"><a href="{{ asset('') }}{{ $post->path_file }}"><i class="fa fa-file"></i> Xem file</a></td>
              <td class="text-center">{{ $post->time }} phút</td>
              <td class="text-center">{{ $post->total }}</td>
              <td class="text-center"><a href="/user/{{$post->user_id}}">{{ $users->find($post->user_id)->name }}</a></td>
              <td class="text-center">{{ date_format($post->created_at, "d-m-Y") }}</td>
            </tr>
           @endforeach
          </tbody>
        </table>
        <div class="panel-footer">
        	<div class="pull-right">
        	{{ $posts->links() }}
        	</div>
        </div>
      </div>
    </div>
</div>
</div>
@endsection