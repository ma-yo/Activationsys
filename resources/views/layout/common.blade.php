<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')｜Blade Template file</title>

    <link rel="stylesheet" href="css/local/bootstrap/bootstrap-4.3.1.min.css?{{$commons['systemdate']}}">
    <link rel="stylesheet" href="css/local/fontawesome/fontawesome-5.14.0.all.css?{{$commons['systemdate']}}">
    <link rel="stylesheet" href="css/common.css?{{$commons['systemdate']}}">
    @yield('css')

    <!--[if lt IE 9]>
    <script src="js/local/html5shiv/html5shiv-3.7.2.min.js?{{$commons['systemdate']}}"></script>
  <script src="js/local/respond/respond-1.4.2.min.js?{{$commons['systemdate']}}"></script>
  <![endif]-->

</head>

<body>
    <nav class="container-fluid navbar navbar-expand-sm navbar-light bg-dark">
        <div class="row w-100 m-0">
            <div class="col-xs-12 col-md-12 col-lg-7 p-0">
                <span id="brand-area" class="navbar-brand h1 h1-title text-white my-auto">Activation System</span>
                <span id="bread-crunb" class="h6 h6-title text-white my-auto">@if(isset($commons['subtitle']))
                    {{$commons['subtitle']}} @endif</span>
            </div>
            @if(isset($commons['username']))
            <div class="col-xs-12 col-md-12 col-lg-3 my-auto h6 h6-title text-white text-right p-0">
              <span>LOGIN :{{$commons['username']}}さん</span>
              <span id="navbar-pipe"> | </span>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-2 my-auto pt-0 pb-0">
                <form class="form text-right" id="logout-form" name="logout-form" action="/logout" method="get">
                    @csrf
                    <button class="btn btn-secondary mt-1 mb-1 p-1" type="submit" id="logout-button"
                        name="logout-button">ログアウト</button>
                </form>
            </div>
        </div>
        @endif
    </nav>

    <div class="container mt-2">
        @if(isset($commons['messageType']) && isset($commons['message']))
        <div class="row">
          <div class="col-md-12">
            @switch($commons['messageType'])
            @case("PRIMARY")
            <div class="alert alert-primary">{{$commons['message']}}</div>
            @break
            @case("SECONDARY")
            <div class="alert alert-secondary">{{$commons['message']}}</div>
            @break
            @case("SUCCESS")
            <div class="alert alert-success">{{$commons['message']}}</div>
            @break
            @case("DANGER")
            <div class="alert alert-danger">{{$commons['message']}}</div>
            @break
            @case("WARNING")
            <div class="alert alert-warning">{{$commons['message']}}</div>
            @break
            @case("INFO")
            <div class="alert alert-info">{{$commons['message']}}</div>
            @break
            @case("LIGHT")
            <div class="alert alert-light">{{$commons['message']}}</div>
            @break
            @case("DARK")
            <div class="alert alert-dark">{{$commons['message']}}</div>
            @break
            @endswitch
          </div>
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
                    <div class="spinner-border text-primary" id="progress-modal-spinner"
                        style="width: 2rem; height: 2rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- インフォモーダル -->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="info-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="info-modal-header" class="modal-header bg-info text-white">
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
                    <button type="button" id="info-modal-ok-button" name="info-modal-ok-button"
                        class="btn btn-info text-white" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 確認ダイアログ -->
    <div class="modal fade" id="okcancel-modal" tabindex="-1" role="dialog" aria-labelledby="okcancel-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="okcancel-modal-header" class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="okcancel-modal-title">TITLE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center align-middle">
                    <table>
                        <tr>
                            <td><i id="okcancel-modal-icon" name="okcancel-modal-icon"
                                    class="fas fa-info-circle fa-2x text-info"></i></td>
                            <td class="align-middle"><span class="ml-2" id="okcancel-modal-message"
                                    name="okcancel-modal-message">MESSAGE</span></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="okcancel-modal-ok-button" name="okcancel-modal-ok-button"
                        class="btn btn-info text-white">OK</button>
                    <button type="button" id="okcancel-modal-cancel-button" name="okcancel-modal-cancel-button"
                        class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/local/jquery/jquery-3.5.1.min.js?{{$commons['systemdate']}}"></script>
    <script src="js/local/bootstrap/popper-1.14.7.min.js?{{$commons['systemdate']}}"></script>
    <script src="js/local/bootstrap/bootstrap-4.3.1.min.js?{{$commons['systemdate']}}"></script>
    <script src="js/local/encoding/encoding-japanese-1.0.30.min.js?{{$commons['systemdate']}}"></script>
    <script src="js/common.js?{{$commons['systemdate']}}"></script>

    @yield('js')
</body>

</html>
