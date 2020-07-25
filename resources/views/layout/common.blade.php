<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')｜Blade Template file</title>
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">  
  <link href="css/common.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">

  @yield('css')

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-dark">
    <span class="navbar-brand mb-0 h1 text-white">Activation System</span>
    <span class="mb-0 h6 text-white mr-auto">@if(isset($commons['subtitle'])) {{$commons['subtitle']}} @endif</span>
    
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

<!-- プログレスモーダル -->
<div class="modal fade" id="progress-modal" tabindex="-1" role="dialog" aria-labelledby="progress-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div id="progress-modal-header" class="modal-header bg-info text-white">
                <h5 class="modal-title" id="progress-modal-title"></h5>
            </div>
            <div class="modal-body form-inline mx-auto">
                <div id="progress-modal-message"></div>
                <div class="spinner-border text-primary" id="progress-modal-spinner" style="width: 2rem; height: 2rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- インフォモーダル -->
<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div  id="info-modal-header" class="modal-header bg-info text-white">
          <h5 class="modal-title" id="info-modal-title">TITLE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <td><i id="info-modal-icon" class="fas fa-info-circle fa-2x text-info"></i></td>
              <td class="align-middle"><span class="ml-3" id="info-modal-message">MESSAGE</span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" id="info-modal-ok-button" name="info-modal-ok-button" class="btn btn-info text-white" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
  <!-- 確認ダイアログ -->
  <div class="modal fade" id="okcancel-modal" tabindex="-1" role="dialog" aria-labelledby="okcancel-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div  id="okcancel-modal-header" class="modal-header bg-info text-white">
          <h5 class="modal-title" id="okcancel-modal-title">TITLE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center align-middle">
          <table>
            <tr>
              <td><i id="okcancel-modal-icon" name="okcancel-modal-icon" class="fas fa-info-circle fa-2x text-info"></i></td>
              <td class="align-middle"><span class="ml-2" id="okcancel-modal-message" name="okcancel-modal-message">MESSAGE</span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" id="okcancel-modal-ok-button" name="okcancel-modal-ok-button" class="btn btn-info text-white">OK</button>
          <button type="button" id="okcancel-modal-cancel-button" name="okcancel-modal-cancel-button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        </div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/encoding-japanese/1.0.30/encoding.min.js" integrity="sha512-rqL5c2sp6KdRdB27P16dSYF9J3/WrP+UHrKuzWiN6304wz0bzv1ZE8G+zieQGSnNfg9UasgKNOQzv4yir7+Prg==" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/common.js?{{$commons['systemdate']}}"></script>

@yield('js')
</body>
</html>