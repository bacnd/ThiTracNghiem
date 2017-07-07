@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thành viên</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><span class="fa fa-user" aria-hidden="true"></span> Thành viên</h3>
            </div>
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="text-center">Avatar</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Gender</th>
                  <th class="text-center">Email</th>
                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr>
                  <td class="text-center"><img src="{{ asset('avatars') }}/{{ $user->avatar }}" class="avatar" width=40 height=40 alt=""></td>
                  <td class="text-center"><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
                  <td class="text-center">{{ ($user->gender == 'm') ? 'Nam' : 'Nữ'}}</td>
                  <td class="text-center">{{ $user->email }}</td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
        </div>
		</div>
</div>
@endsection