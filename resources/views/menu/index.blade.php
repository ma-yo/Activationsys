@extends('layout.common')
@section('title', 'アクティベーションシステム - メニュー')
@section('css')
<link href="css/menu-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/menu-index.js"></script>
@endsection

@section('content')

<div id="menu">
    <form id="menu-form" class="form" action="{{url('/menu')}}" method="post">
        @csrf
        <input type="hidden" id="menu-type" name="menu-type" value=""/>
        <div class="form-group">
            <label for="lic-title" class="text-info">ライセンス管理</label><br>
            <div class="container border border-info p-3 rounded">
                <input type="submit" id="gen-serial" name="gen-serial" class="btn btn-info btn-md" value="シリアル生成">
                <input type="submit" id="del-serial" name="del-serial" class="btn btn-warning btn-md" value="シリアル削除">
                <input type="submit" id="download-serial" name="download-serial" class="btn btn-info btn-md" value="CSV出力">
            </div>
        </div>
    </form>
</div>
@endsection
