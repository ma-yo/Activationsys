@extends('layout.common')
@section('title', 'アクティベーションシステム - ログイン')
@section('css')
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/login-index.css" rel="stylesheet" type="text/css">
@endsection
@section('js')
<script type="text/javascript" src="js/login-index.js"></script>
@endsection
@section('content')
<div id="login">
    <div class="row justify-content-center align-items-center">
        <div class="bg-info text-center mt-5" style="width:400px;">
            <img src="{{ asset('/img/logo.png') }}" width="80px" />
            <h2 class="text-center text-white mt-1">ACTIVATION SYSTEM</h2>
            <h3 class="text-center text-white">LOGIN</h3>
        </div>
    </div>
    <div class="row justify-content-center align-items-center">
        <form id="login-form" name="login-form" class="form p-2" action="/login" method="post" style="width:400px;">
            @csrf
            <div class="form-group @if(!empty($errors->first('login-username'))) has-error @endif">
                <label for="username" class="text-info">Username:</label><br>
                <input type="text" name="login-username" id="login-username" value="{{old('login-username')}}" class="form-control">
                <span class="help-block text-danger">{{$errors->first('login-username')}}</span>
            </div>
            <div class="form-group @if(!empty($errors->first('login-password'))) has-error @endif">
                <label for="password" class="text-info">Password:</label><br>
                <input type="password" name="login-password" id="login-password"  value="{{old('login-password')}}" class="form-control">
                <span class="help-block text-danger">{{$errors->first('login-password')}}</span>
            </div>

            <div class="form-group">
                <button type="button" id="login-button" name="login-button" class="btn btn-info btn-lg"> LOGIN </button>
            </div>
        </form>
    </div>
</div>
@endsection
