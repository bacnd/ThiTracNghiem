@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tạo chuyên mục</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
  <div class="col-md-6">
    <form action="{{ route('cat.store') }}" method="POST" role="form">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="name_cat">Name category:</label>
        <input type="text" name="name_cat" id="name_cat" class="form-control">
      </div>
      
      <button class="btn btn-primary pull-right" tyle="submit">Submit</button>
    </form>
  </div>
</div>
</div>
@endsection