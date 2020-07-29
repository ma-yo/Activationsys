@extends('layout.common')
@section('title', 'アクティベーションシステム - アプリケーション登録済')
@section('css')
<link href="css/application-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/application-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="application-result">
<p class="h2 h2-title text-primary">アプリケーション登録を行いました。</p>
<form id="menuback-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        <span class="mr-auto"></span>
        <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">戻る</button>
    </div>
    <table id="resultapplication-table" class="table table-hover">
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
                    <td><small>{{ $app->appid }}</small></td>
                        <td><small>{{ $app->name }}</small></td>
                        <td><small>{{ $app->created_at }}</small></td>
                        <td><small>{{ $app->updated_at }}</small></td>
                @endforeach
                </tr>
            </tbody>
        @endif
    </table>
</form>
</div>
@endsection
