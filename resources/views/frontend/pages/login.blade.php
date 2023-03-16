@extends('frontend.layouts.master')

@section('title','Devifo || Login')

@section('main-content')
    <!-- Breadcrumbs -->
    {{-- <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    @if (Auth::user())
                    <div class="login-form">
                        <h2>Welcome {{ Auth::user()->name}}</h2>
                                <div class="col-12 text-center">
                                    <div class="form-group login-btn">
                                   
                                    @if(Auth::user()->role=='admin')
                                    
                                    <a href="{{route('admin')}}" class="btn btn-facebook"  target="_blank"><i class="ti-home"></i> Dashboard</a><br>
                                @else 
                                    <a href="{{route('user')}}" class="btn btn-facebook" target="_blank"><i class="ti-home"></i> Dashboard</a><br>
                                @endif
                                    <a href="{{route('user.logout')}}" class="btn btn-facebook"><i class="ti-power-off"></i> Logout</a>

                           
                                    
                                </div>
                            </div>
                        </div>
                    @else

                        <div class="login-form">
                            <h2>Login</h2>
                                    <div class="col-12 text-center">
                                        <div class="form-group login-btn">
                                       
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook">
                                            <i class="ti-facebook"></i> Login With Facebook
                                        </a>
                                        <a href="{{route('login.redirect','google')}}" class="btn btn-google">
                                            <i class="ti-google"></i> Login With Google
                                        </a>
                                    </div>
                                </div>
                            </div>
                    @endif
                    
                        </div>
                    </div>
                </div>
            </section>
    <!--/ End Login -->
@endsection
@push('styles')
<style>
    .shop.login .form .btn{
        margin-right:0;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#ea4335;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
</style>
@endpush