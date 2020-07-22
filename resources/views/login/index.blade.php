@extends('layout.common')
@section('title', 'アクティベーションシステム - ログイン')
@section('css')
<link href="css/login-index.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
<div id="login">
    <h3 class="text-center text-white pt-5">Activation System</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="{{ url('/login')}}" method="post">
                        @csrf
                        <input type="hidden" id="content" name="content" value="login"/>
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="login-username" id="login-username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="login-password" id="login-password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="login-button" name="login-button" class="btn btn-info btn-md" value="LOGIN">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
