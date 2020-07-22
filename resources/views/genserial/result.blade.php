@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル作成成功')
@section('css')
<link href="css/genserial-result.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/genserial-result.js"></script>
@endsection

@section('content')

<p class="h4 text-dark">下記シリアルを認証ユーザーへ通知してください。</p>
<div class="border border-primary rounded p-3 mb-3">
<label class="text-dark">E-MAIL : </label>
<p class="text-primary h4">{{$email}}</p>
<label class="text-dark">ユーザー名 : </label>
<p class="text-primary h4">{{$activateduser}}</p>
<label class="text-dark">シリアル : </label>
<p class="text-danger h4">{{$serial}}</p>
<label class="text-dark">登録日 : </label>
<p class="text-primary h4">{{$created_at}}</p>
</div>


<form id="menu-form" class="form" action="{{ url('/menu')}}" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" id="menu-type" name="menu-type" value="menu"/>
        <input type="submit" id="return-menu-button" name="return-menu-button" class="btn btn-info btn-md" value="メニューに戻る">
    </div>
</form>

@endsection
