@extends('layout.common')
@section('title', 'アクティベーションシステム - アプリケーション登録')
@section('css')
<link href="css/application-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/application-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<form id="application-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        <p class="text-info h4 h4-title">アプリケーションを登録します。</p>
        <span class="mr-auto"></span>
        <button type="button" id="update-button" name="update-button" class="btn btn-primary btn-md ml-2">適用</button>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>アプリケーションID</th>
                <th>アプリケーション名</th>
                <th>登録日時</th>
                <th>更新日時</th>
            </tr>
        </thead>
        @if(!empty($datas['applications']))
            <tbody>
                @foreach($datas['applications'] as $key => $app)
                    <tr>
                    <td><input type='hidden' name="appid[{{$key}}]" value = "{{ $app->appid }}" /> {{ $app->appid }}</td>
                        <td>
                            <input type='text' name="appname[{{$key}}]" class="form-control @if(!empty($errors->first('appname.' . $key))) is-invalid @endif" value="{{ $app->name }}" />
                            <span class="text-danger">{{$errors->first('appname.' . $key)}}</span>
                        </td>
                        <td><small>{{ $app->created_at }}</small></td>
                        <td><small>{{ $app->updated_at }}</small></td>
                @endforeach
                </tr>
            </tbody>
        @endif
    </table>
</form>
@endsection
