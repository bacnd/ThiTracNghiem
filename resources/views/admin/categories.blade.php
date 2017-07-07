@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Chuyên mục</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><span class="fa fa-files-o fa-fw" aria-hidden="true"></span> Chuyên mục</h3>
            </div>
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="text-center">Name</th>
                  <th class="text-center">Total posts</th>
                </tr>
              </thead>
              <tbody>
              @foreach($categories as $cat)
                <tr>
                  <td class="text-center"><a href="{{ route('cat.show', $cat->id) }}">{{ $cat->name }}</a></td>
                  <td class="text-center">{{ count($cat->posts) }}</td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
        </div>
		</div>
</div>
@endsection