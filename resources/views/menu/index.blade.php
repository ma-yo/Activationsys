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
            <label for="lictitle-label" class="h2 h2-title text-dark">ライセンス管理メニュー</label><br>
            <div class="border border-dark p-3 rounded">
                <button type="button" id="genserial-button" name="genserial-button" class="btn btn-info">シリアル生成</button>
                <button type="button" id="delserial-button" name="delserial-button" class="btn btn-info">シリアル削除</button>
                <button type="button" id="serialunlock-button" name="serialunlock-button" class="btn btn-info">シリアル凍結リセット</button>
            </div>
        </div>
        <div class="form-group">
            <label for="iotitle-label" class="h2 h2-title text-dark">帳票・ファイル出力メニュー</label><br>
            <div class="border border-dark p-3 rounded">
                <button type="button" id="downloadserial-button" name="downloadserial-button" class="btn btn-info">登録情報CSV出力</button>
                <button type="button" id="licenseinfo-button" name="licenseinfo-button" class="btn btn-info">ライセンス情報</button>
            </div>
        </div>
        @if($commons['authority'] == "1")
        <!-- 管理者メニュー -->
        <div class="form-group">
            <label for="maintenancetitle-label" class="h2 h2-title text-dark">管理者メニュー</label><br>
            <div class="border border-dark p-3 rounded">
                <button type="button" id="settinfinfo-button" name="settinginfo-button" class="btn btn-info">設定値編集</button>
                <button type="button" id="createuser-button" name="createuser-button" class="btn btn-info">ユーザー作成</button>
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-info">ユーザー編集</button>
                <button type="button" id="downloaduser-button" name="downloaduser-button" class="btn btn-info">ユーザー情報CSV出力</button>
                <button type="button" id="createapplication-button" name="createapplication-button" class="btn btn-info">アプリケーション登録</button>
            </div>
        </div>
        @endif
        @if($commons['authority'] == "2")
        <!-- 一般ユーザーメニュー -->
        <div class="form-group">
            <label for="maintenancetitle-label" class="h2 h2-title text-dark">一般ユーザーメニュー</label><br>
            <div class="container border border-dark p-3 rounded">
                <button type="button" id="edituser-button" name="edituser-button" class="btn btn-info">ユーザー編集</button>
            </div>
        </div>
        @endif
    </form>
</div>
<!-- モーダルダイアログにてOKを押下した際のイベント切り分け用 -->
<input type="hidden" id="menu-action" name="menu-action" value=""/>
@endsection
