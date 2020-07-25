@extends('layout.common')
@section('title', 'アクティベーションシステム - メニュー')
@section('css')
<link href="css/menu-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/menu-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="menu">
    <form id="menu-form" class="form" action="{{ url('/menu') }}" method="get">
        @csrf
        <div class="form-group">
            <label for="lictitle-label" class="h4 text-info">ライセンス管理メニュー</label><br>
            <div class="container border border-info p-3 rounded">
                <button type="button" id="genserial-button" name="genserial-button" class="btn btn-info btn-lg">シリアル生成</button>
                <button type="button" id="delserial-button" name="delserial-button" class="btn btn-info btn-lg">シリアル削除</button>
                <button type="button" id="serialunlock-button" name="serialunlock-button" class="btn btn-info btn-lg">シリアル凍結リセット</button>
            </div>
        </div>
        <div class="form-group">
            <label for="iotitle-label" class="h4 text-primary">帳票・ファイル出力メニュー</label><br>
            <div class="container border border-primary p-3 rounded">
                <button type="button" id="downloadserial-button" name="downloadserial-button" class="btn btn-primary btn-lg">登録情報CSV出力</button>
            </div>
        </div>
        @if($commons['authority'] == "1")
        <div class="form-group">
            <label for="maintenancetitle-label" class="h4 text-dark">管理者メニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="settinfinfo-button" name="settinginfo-button" class="btn btn-dark btn-lg">設定値編集</button>
                <button type="button" id="createuser-button" name="createuser-button" class="btn btn-dark btn-lg">ユーザー作成</button>
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-dark btn-lg">ユーザー編集</button>
                <button type="button" id="downloaduser-button" name="downloaduser-button" class="btn btn-primary btn-lg">ユーザー情報CSV出力</button>
            </div>
        </div>
        @endif
        @if($commons['authority'] == "2")
        <div class="form-group">
            <label for="maintenancetitle-label" class="h4 text-dark">一般ユーザーメニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-dark btn-lg">ユーザー編集</button>
            </div>
        </div>
        @endif
    </form>
</div>
<input type="hidden" id="menu-action" name="menu-action" value=""/>
@endsection
