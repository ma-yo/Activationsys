@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル作成')
@section('css')
<link href="css/genserial-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/genserial-index.js"></script>
@endsection

@section('content')

<p class="text-dark h2">シリアル生成ユーザー情報を入力してください。</p>
<form id="genserial-form" class="form border border-info p-3 rounded" action="{{ url('/genserial')}}" method="post">
    @csrf
    <input type="hidden" id="content" name="content" value="genserial"/>
    <div class="form-group">
        <input type="text" id="username" name="username" class="form-control" value="" placeholder="適用ユーザー名を設定してください。" required> 
    </div>
    <div class="form-group">
        <input type="email" id="email" name="email" class="form-control" value="" placeholder="Emailを設定してください。" required> 
    </div>
    <div class="form-group">
        <input type="submit" id="genserial" name="genserial" class="btn btn-info btn-md" value="シリアル作成">
        <input type="submit" id="menu" name="menu" class="btn btn-secondary btn-md" value="戻る">
    </div>
</form>

@endsection
