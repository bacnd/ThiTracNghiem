@extends('layouts.app')

@section('style')
<style>
html, body {
  height: 100%;
  overflow: hidden;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <form action="{{ route('posts.store') }}" method="POST" role="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-6 animated fadeInLeft" name="upload">
            <div class="panel-default pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
                <div class="panel-body">
                    <legend>Upload Exam</legend>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="type">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required> 
                        </div>
                        <div class="form-group pmd-textfield">
                          <label for="sel1">Select category:</label>
                          <select class="form-control" name="category">
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="type">Time</label>
                            <input type="number" class="form-control" id="time" name="time" value="{{ old('time') }}" required> 
                        </div>
                        <div class="form-group pmd-textfield">
                            <label for="file">File</label>
                            <label class="btn-bs-file pmd-btn-raised btn btn-sm btn-primary">
                                <p>Choose a file</p>
                                <input type="file" class="form-control" id="fileExam" name="fileExam" required>
                            </label>
                        </div>
                        <button type="submit" class="btn pmd-ripple-effect pmd-btn-raised btn-primary">Submit</button>
                </div>
            </div>
        </div>

        <div class="col-md-6 animated fadeInRight" id="answer">
            <div class="panel-default pmd-card pmd-card-default pmd-z-depth pmd-card-custom-form">
                <div class="panel-body">
                    <legend>Answer</legend>

                    <h4>Số câu: <span class="color-red" id="total">1</span></h4>
                    <input type="hidden" value="1" name="_total" id="_total">
                    <div class="row form-group pmd-textfield">
                        <div class="col-md-6">
                            <input type="number" class="form-control pull-left" value="1" id="total_add" name="total_add">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn pmd-ripple-effect pmd-btn-raised btn-primary pull-right" id="btn_add">Add</button>
                        </div>
                    </div>
                
                    <div class="row form-group pmd-textfield pmd-textfield-floating-label">
                        <div class="col-md-6">
                            <input type="number" class="form-control pull-left" id="total_remove" name="total_remove" value="0">
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn pmd-ripple-effect pmd-btn-raised btn-primary pull-right" id="btn_remove">Remove</button>
                        </div>
                    </div>

                    <div id="add_answer" class="scroll_check_create">
                        <div id="ans" index="1">
                            <label><span class="number color-red">1:</span></label><label class="radio-inline control control--radio"><input type="radio" value="A" name="check-1" required>A<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="B" name="check-1">B<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="C" name="check-1">C<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="D" name="check-1">D<div class="control__indicator"></div></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    var d = 0;
    var total = $('#ans').length;

    $('#btn_add').click(function() {    
        var total_add = $('#total_add').val();
        var html = '';
        
        for (var i = total; i < (parseInt(total_add)+total); i++) {
            d = i + 1;    
            html += '<div id="ans" index="'+d+'"><label><span class="number color-red">'+d+':</span></label><label class="radio-inline control control--radio"><input type="radio" value="A" name="check-'+d+'" required>A<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="B" name="check-'+d+'">B<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="C" name="check-'+d+'">C<div class="control__indicator"></div></label><label class="radio-inline control control--radio"><input type="radio" value="D" name="check-'+d+'">D<div class="control__indicator"></div></label></div>';
        }
        $('#add_answer').append(html);
        total += parseInt(total_add);
        $('#total').text(total);
        
        $('#_total').val(total);
    });

    $('#btn_remove').click(function() { 

        var total_remove = parseInt($('#total_remove').val());

        if(total_remove < 1) {
            $.toast({
                text: 'Số câu cần xoá phải lớn hơn 0',
                position: 'bottom-right',
                icon: 'error',
                loader: false,
                showHideTransition: 'plain',
                stack: 10
            });
        } else if(total_remove > total) {
            $.toast({
                text: 'Số câu cần xoá phải nhỏ hơn số câu hiện tại',
                position: 'bottom-right',
                icon: 'error',
                loader: false,
                showHideTransition: 'plain',
                stack: 10
            });
        } else if(total - parseInt(total_remove) < 1) {
            $.toast({
                text: 'Số câu phải lớn hơn 0',
                position: 'bottom-right',
                icon: 'error',
                loader: false,
                showHideTransition: 'plain',
                stack: 10
            });
        } else {

            for(var i = total; i > (total - parseInt(total_remove)); i--) {
                $('#add_answer').find('#ans[index='+i+']').remove();
            }

            total -= parseInt(total_remove);
            $('#total').text(total);

            $('#_total').val(total);

            $.toast({
                text: 'Xoá thành công!',
                position: 'bottom-right',
                icon: 'info',
                loader: false,
                showHideTransition: 'plain',
                stack: 10
            });
        }

    });

    $('#fileExam').change(function(){
        $('.btn-bs-file p').text($(this).val().replace(/C:\\fakepath\\/i, ''));
    });

});
</script>
@endsection
