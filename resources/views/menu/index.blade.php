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
            <label for="lictitle-label" class="h2 text-dark">ライセンス管理メニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="genserial-button" name="genserial-button" class="btn btn-dark">シリアル生成</button>
                <button type="button" id="delserial-button" name="delserial-button" class="btn btn-dark">シリアル削除</button>
                <button type="button" id="serialunlock-button" name="serialunlock-button" class="btn btn-dark">シリアル凍結リセット</button>
            </div>
        </div>
        <div class="form-group">
            <label for="iotitle-label" class="h2 text-dark">帳票・ファイル出力メニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="downloadserial-button" name="downloadserial-button" class="btn btn-primary">登録情報CSV出力</button>
            </div>
        </div>
        @if($commons['authority'] == "1")
        <!-- 管理者メニュー -->
        <div class="form-group">
            <label for="maintenancetitle-label" class="h2 text-dark">管理者メニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="settinfinfo-button" name="settinginfo-button" class="btn btn-dark">設定値編集</button>
                <button type="button" id="createuser-button" name="createuser-button" class="btn btn-dark">ユーザー作成</button>
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-dark">ユーザー編集</button>
                <button type="button" id="downloaduser-button" name="downloaduser-button" class="btn btn-primary">ユーザー情報CSV出力</button>
            </div>
        </div>
        @endif
        @if($commons['authority'] == "2")
        <!-- 一般ユーザーメニュー -->
        <div class="form-group">
            <label for="maintenancetitle-label" class="h2 text-dark">一般ユーザーメニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-dark">ユーザー編集</button>
            </div>
        </div>
        @endif
    </form>
</div>
<!-- モーダルダイアログにてOKを押下した際のイベント切り分け用 -->
<input type="hidden" id="menu-action" name="menu-action" value=""/>
@endsection
