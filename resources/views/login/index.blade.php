@extends('layout.common')
@section('title', 'アクティベーションシステム - ログイン')
@section('css')
<link href="css/login-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection
@section('js')
<script type="text/javascript" src="js/login-index.js?{{$commons['systemdate']}}"></script>
@endsection
@section('content')
<div id="login">
    <div class="row justify-content-center align-items-center">
        <div class="bg-dark text-center mt-5" style="width:400px;">
            <img src="img/logo.png?{{$commons['systemdate']}}" width="80px" />
            <h2 class="text-center text-white mt-1 h2-title">ACTIVATION SYSTEM</h2>
            <h3 class="text-center text-white h3-title">LOGIN</h3>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <form id="login-form" name="login-form" class="form p-2" action="/login" method="post" style="width:400px;">
            @csrf
            <div class="form-group">
                <label for="username" class="text-dark">Username:</label><br>
                <input type="text" name="login-username" id="login-username" value="{{old('login-username')}}" class="form-control @if(!empty($errors->first('login-username'))) is-invalid @endif">
                <div class="text-danger">{{$errors->first('login-username')}}</div>
            </div>
            <div class="form-group">
                <label for="password" class="text-dark">Password:</label><br>
                <input type="password" name="login-password" id="login-password"  value="{{old('login-password')}}" class="form-control @if(!empty($errors->first('login-password'))) is-invalid @endif">
                <div class="text-danger">{{$errors->first('login-password')}}</div>
            </div>

            <div class="form-group">
                <button type="button" id="login-button" name="login-button" class="btn btn-dark btn-lg"> LOGIN </button>
            </div>
        </form>
    </div>
</div>
@endsection
