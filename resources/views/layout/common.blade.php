<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')｜Blade Template file</title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  
  @yield('css')

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-info">
    <span class="navbar-brand mb-0 h1 text-white mr-auto">Activation System</span>
    
    @if(isset($commons['username']))
    <span class="mb-0 text-white mr-1">LOGIN :</span>
    <span class="mb-0 text-white mr-3">{{$commons['username']}}さん</span>
    <span class="mb-0 text-white mr-3">|</span>
    <form class="form form-inline my-2 my-md-0" id="logout-form" name="logout-form" action="/logout" method="get">
        @csrf
        <button class="form-control btn btn-secondary" type="submit" id="logout-button" name="logout-button">ログアウト</button>
    </form>
    @endif
</nav>

<div class="container mt-2">
@if(isset($commons['messageType']) && isset($commons['message']))
    <div class="row">
        @switch($commons['messageType'])
        @case("PRIMARY")
        <div class="alert alert-primary col-sm-12">{{$commons['message']}}</div>
            @break
        @case("SECONDARY")
        <div class="alert alert-secondary col-sm-12">{{$commons['message']}}</div>
            @break
        @case("SUCCESS")
        <div class="alert alert-success col-sm-12">{{$commons['message']}}</div>
            @break
        @case("DANGER")
        <div class="alert alert-danger col-sm-12">{{$commons['message']}}</div>
            @break
        @case("WARNING")
        <div class="alert alert-warning col-sm-12">{{$commons['message']}}</div>
            @break
        @case("INFO")
        <div class="alert alert-info col-sm-12">{{$commons['message']}}</div>
            @break
        @case("LIGHT")
        <div class="alert alert-light col-sm-12">{{$commons['message']}}</div>
            @break
        @case("DARK")
        <div class="alert alert-dark col-sm-12">{{$commons['message']}}</div>
            @break
        @endswitch
    </div>
@endif

@yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/encoding-japanese/1.0.30/encoding.min.js" integrity="sha512-rqL5c2sp6KdRdB27P16dSYF9J3/WrP+UHrKuzWiN6304wz0bzv1ZE8G+zieQGSnNfg9UasgKNOQzv4yir7+Prg==" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/common.js"></script>

@yield('js')
</body>
</html>