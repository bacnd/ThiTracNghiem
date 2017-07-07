@extends('layouts.app')

@section('style')
<style>
html, body {
  height: 100%;
  overflow: hidden;
}
.navbar {
 margin-bottom: 0; 
}
.col-md-9 {
	padding-right: 0;
}
</style>
@endsection

@section('content')

 	<?php 

        $cat_name = '';

        switch (trim(mb_strtoupper($cat->name))) {
            case "TOÁN" : 
                $cat_name = "toan"; 
                break;
            case 'VẬT LÝ' : 
                $cat_name = 'vatly'; 
                break;
            case 'HOÁ HỌC' : 
                $cat_name = 'hoahoc'; 
                break;
            case 'SINH HỌC' : 
                $cat_name = 'sinhhoc'; 
                break;
            case 'TIẾNG ANH' : 
                $cat_name = 'tienganh'; 
                break;

            default: break;
        }

    ?>

    <div class="row" id="app">
        <div class="col-md-9 {{ $cat_name }}" id="upload">
			<div class="heading">
				<h1 class="title">{{ $post->title }}</h1> 
			<hr></div>
			<p class="description">
				Câu hỏi: <span class="color-red">{{ $post->total }}</span>, thời gian: <span class="color-red">{{ $post->time }} phút</span>, môn học: <a href="{{ route('cat.show', $post->cat_id) }}"><span class="color-red">{{ $post->categories->name }}</span></a>, người đăng: <a href="/user/{{$post->user_id}}">{{ $post->users->name }}</a>
            </p>
        	<div class="luu-y">
        		<h3 class="text-center" style="line-height:1.3em" id="start">Hãy nhấn <a href="#" class="color-red">BẮT ĐẦU</a> để làm bài</h3>
				<h3 class="color-red">* LƯU Ý</h3>
				<ul>
					<li>Số điểm lần đầu tiên làm bài sẽ có giá trị xếp hạng trong bài thi</li>
					<li>Số điểm của bài thi chỉ có giá trị xếp hạng trong bài thi</li>
					<li>Số điểm thi không được cộng vào điểm tổng</li>
					<li>Hãy cố gắng đứng đầu <i class="iconsprite-mini iconmini-rank"></i> <span class="color-red">BẢNG ĐIỂM</span> nhé </li>
				</ul>
				<h3 class="text-center" id="lucky">Chúc bạn <span class="color-red">LÀM BÀI TỐT</span></h3>
			</div>
			<iframe src ="{{ asset('/viewer/viewer.html?file=') }}{{ asset($post->path_file) }}" width="100%" height="615px" id="exam" style="display: none;"></iframe>

		</div>

		<div class="col-md-3 animated fadeInRight" id="quiz-right">
			<div class="row" id="time">
				<div class="pull-left">
					<i class="glyphicon glyphicon-time"></i> 
					<span class="countdown"></span>
				</div>
				<div class="pull-right">
					<button type="button" class="btn btn-primary pmd-ripple-effect pmd-btn-raised" id="btn_start"> Bắt đầu </button>
					<button type="button" data-target="#alert-dialog" data-toggle="modal" class="btn btn-primary pmd-ripple-effect pmd-btn-raised" id="btn_finish" style="display: none;">Nạp bài</button>
					<button type="button" class="btn btn-primary pmd-ripple-effect pmd-btn-raised" id="btn_restart" style="display: none;"> Làm lại </button>
				</div>
			</div>

			<div class="row" id="result" style="display: none;">
				<h3>Điểm: <span class="color-red score-quiz"></span></h3>
				<ul class="note" style="list-style:none">
					<li><i class="iconcolor" style="background: #e33a3a"></i> Câu sai đã chọn</li>
					<li><i class="iconcolor" style="background: #1abc9c"></i> Câu đúng</li>
					<li><i class="iconcolor" style="background: #2980b9"></i> Câu đúng (chưa chọn)</li>
				</ul>
			</div>

			<div id="add_answer" class="row">
				<div class="heading">
					<h1>Chọn đáp án</h1>
					<hr>
				</div>
				<div class="scroll_check">
				@foreach($results as $key => $result)
	                <div id="ans" index="{{ $key }}">
	                    <label><span class="number">{{ $key }}:</span></label>
	                    <label class="radio-inline control control--radio"><input type="radio" value="A" name="check-{{ $key }}">A<div class="control__indicator"></div></label>
	                    <label class="radio-inline control control--radio"><input type="radio" value="B" name="check-{{ $key }}">B<div class="control__indicator"></div></label>
	                    <label class="radio-inline control control--radio"><input type="radio" value="C" name="check-{{ $key }}">C<div class="control__indicator"></div></label>
	                    <label class="radio-inline control control--radio"><input type="radio" value="D" name="check-{{ $key }}">D<div class="control__indicator"></div></label>
	                </div>
	            @endforeach
	            </div>

	            <div id="value"></div>
			</div>  
		</div>
    </div>

<div tabindex="-1" class="modal fade" id="alert-dialog" style="display: none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body"> Bạn chắc chắn nộp bài chứ? </div>
			<div class="pmd-modal-action text-right">
				<button data-dismiss="modal" id="btn_finishMD" class="btn pmd-ripple-effect btn-primary pmd-btn-flat" type="button">Nộp bài</button>
				<button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default pmd-btn-flat" type="button">Huỷ</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function () {

$('#value').hide();

var timer2 = '{{ $post->time }}'+':00';
$('.countdown').html(timer2);

$('#btn_start, #start').click(function() {

	timer2 = '{{ $post->time }}'+':00';

	if($(':radio:checked').length) {
		$(':radio:checked').prop( "checked", false );
	}

	$('#exam').slideUp( 300 ).delay(200).fadeIn( 400 ).show(0);
	$('#btn_finish').slideUp( 300 ).delay(200).fadeIn( 400 ).show(0);
	$('.scroll_check').show();
	$('#btn_start').hide();
	$('.luu-y').hide();

	$.toast({
        text: 'Thời gian đã bắt đầu, chúc bạn làm bài tốt',
        position: 'bottom-right',
        icon: 'success',
        loader: false,
        showHideTransition: 'plain',
        allowToastClose: false,
        hideAfter: 2000
    });

	set_Interval();

});

var interval;
var endMin, endSec; 
var startMin = parseInt(timer2.split(':')[0], 10), startSec = parseInt(timer2.split(':')[1], 10);
var minutes, seconds;
function set_Interval() {
	interval = setInterval(function() {

	var timer = timer2.split(':');
	minutes = parseInt(timer[0], 10);
	seconds = parseInt(timer[1], 10);
	
	--seconds;
	
	minutes = (seconds < 0) ? --minutes : minutes;

	seconds = (seconds < 0) ? 59 : seconds;
	seconds = (seconds < 10) ? '0' + seconds : seconds;
	
	$('.countdown').html(minutes + ':' + seconds);

	timer2 = minutes + ':' + seconds;

	if (minutes < 0) {
		clear_Interval();
		$('#btn_finishMD').click();
	}

	}, 1000);
}

function clear_Interval() {
	clearInterval(interval);
	endMin = (minutes > 0) ? startMin - minutes - 1 : startMin - minutes;
	endSec = (startSec - seconds < 0) ? 60 - seconds : startSec - seconds;

	$('.countdown').html("Hết giờ");
}

$('#btn_finishMD').click(function() {

	var total = $('#add_answer .scroll_check #ans').length;

	var _check = '';
	
	for(var i = 1; i <= total; i++) {

		var ck = $('div[index='+i+'] input:checked').val();
		if (typeof ck !== typeof undefined && ck !== false) {
			_check += ck;
		} else {
			_check += '0';
		}

	}

	$('.scroll_check').hide();

	var html = '';

	var results = {!! $post->result !!};

	var right = 0;
	for(var i = 1; i <= total; i++) {
		var a = '';
		var b = '';
		var c = '';
		var d = '';
		if(_check[i-1] == results[i]) {
			// Cau dung
			right++;
			switch(results[i]) {
				case 'A' : a = 'class="active"'; break;
				case 'B' : b = 'class="active"'; break;
				case 'C' : c = 'class="active"'; break;
				case 'D' : d = 'class="active"'; break;

				default : break;
			}
		} else if(_check[i-1] == '0') {
			// Cau dung chua chon
			switch(results[i]) {
				case 'A' : a = 'class="check-item-blue"'; break;
				case 'B' : b = 'class="check-item-blue"'; break;
				case 'C' : c = 'class="check-item-blue"'; break;
				case 'D' : d = 'class="check-item-blue"'; break;

				default : break;
			}
		} else {
			// Cau sai
			switch(_check[i-1]) {
				case 'A' : a = 'class="check-item-error"'; break;
				case 'B' : b = 'class="check-item-error"'; break;
				case 'C' : c = 'class="check-item-error"'; break;
				case 'D' : d = 'class="check-item-error"'; break;

				default : break;
			}

			switch(results[i]) {
				case 'A' : a = 'class="active"'; break;
				case 'B' : b = 'class="active"'; break;
				case 'C' : c = 'class="active"'; break;
				case 'D' : d = 'class="active"'; break;

				default : break;
			}
		}

		html += '<ul id="check-quiz" class="check-quiz check-quized"><li index="'+i+'"><span class="number color-red">'+i+':</span><a href="#" index="1"'+a+'>A</a><a href="#" index="2"'+b+'>B</a><a href="#" index="3"'+c+'>C</a><a href="#" index="4"'+d+'>D</a></li></ul>';
	}

	$('#value').slideUp( 300 ).delay( 200 ).fadeIn( 300 ).html(html);
	$('.score-quiz').html(right+'/'+total);

	$('#btn_finish').hide();
	$('#btn_restart').show();
	$('#result').slideUp( 300 ).delay(200).fadeIn( 100 ).show(0);

	clear_Interval();

	$.toast({
        text: 'Bạn đạt được ' + right+'/'+total,
        position: 'bottom-right',
        icon: 'success',
        loader: false,
        showHideTransition: 'plain',
        allowToastClose: false,
        hideAfter: 2000
    });

	$.ajax({
        url : "{{ route('er.store') }}",
        type : "post",
        dataType:"text",
        data : {
        	_token: "{{ csrf_token() }}",
            point: right,
            time: endMin+":"+endSec, 
            user_id: "{{ $userExams }}",
            post_id: "{{ $post->id }}"
        },
        success : function (result){
            Console.log(result);
        },
        error : function(error){ 
        	Console.log(error);
    	}
    });
});

$('#btn_restart').click(function(){
	$('#btn_start').click();
	$('#btn_restart').hide();
	$('#value').hide();
	$('#result').hide();
});

});
</script>

@endsection
