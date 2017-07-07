@extends('layouts.app')

@section('content')
<div class="container" id="content">
    
    @foreach($categories as $cat) 
    
    <?php 
        $posts = $categories->find($cat->id)->posts;

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
        @if(count($posts)) 
        <div class="row {{ $cat_name }}">
            <div class="heading heading-white">
                <h1><a href="{{ route('cat.show', $cat->id) }}"><i class="glyphicon glyphicon-align-right"></i> Đề thi {{ $cat->name }}</a></h1>
                <hr>
            </div>
            
                @foreach( $posts as $post )
                <div class="exams">
                    <div class="pull-left">
                        <div class="title">
                            <h1>
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                            </h1>
                        </div>

                        <p class="description">
                            Câu hỏi: <span class="color-red">{{ $post->total }}</span>, thời gian: <span class="color-red">{{ $post->time }} phút</span>, người đăng: <a href="/user/{{$post->user_id}}">{{ $post->users->name }}</a>
                        </p>
                    </div>

                    <div class="pull-right btn_truycap">
                        <a href="{{ route('posts.show', $post->id) }}">
                            <button class="btn pmd-ripple-effect pmd-btn-raised btn-primary pull-right">Truy cập</button>
                        </a>
                    </div>
                    <hr/>
                </div>
                @endforeach

        </div>
        @endif
    @endforeach
    
</div>
@endsection
