@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6 col-md-offset-3"><br><br>     
        <!-- Default card starts -->
        <div class="pmd-card pmd-card-default pmd-z-depth text-center index-card">

            <!-- Card header -->
            <div class="pmd-card-title" style=""><br>
                <div class="">
                    <img src="{{ asset('/avatars') }}/{{ $user->avatar }}" class="avatar-120">
                </div>
                <div class="media-body"><br>
                    <h3 class="pmd-card-title-text">{{ $user->name }}</h3>
                    <span class="silver-text" >PHP Laravel Web-Developer</span>
                </div><br>
            </div>
                        
            <!-- Card body -->           
            <div class="pmd-card-body">
                <i class="fa fa-envelope-o silver-text" aria-hidden="true"></i>
                <a class="extra-light-black-text" href="mailto:{{ $user->email }}" target="_top">{{ $user->email }}</a>
            </div>
            
            <!-- Card media actions -->
            <div class="pmd-card-actions">
                <a href="https://twitter.com/RomanPaprotsky" target="_blank">
                    <i class="fa fa-twitter fa-2x silver-text" aria-hidden="true"></i>
                </a>                
                <a href="https://www.youtube.com/channel/UC1gJrXx7mTxxYTculfiAihw" target="_blank">
                    <i class="fa fa-youtube fa-2x silver-text" aria-hidden="true"></i>
                </a>
                <a href="https://gitlab.com/paprotsky" target="_blank">
                    <i class="fa fa-gitlab fa-2x silver-text" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <!--Default card ends -->
    </div>
</div>

@endsection