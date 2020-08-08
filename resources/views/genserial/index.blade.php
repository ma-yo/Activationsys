@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル作成')
@section('css')
<link href="css/genserial-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/genserial-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<form id="genserial-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        <p class="text-info h4 h4-title">シリアル生成ユーザー情報を入力してください。</p>
        <span class="mr-auto"></span>
        <button type="button" id="genserial-button" name="genserial-button" class="btn btn-info btn-md">シリアル作成</button>
    </div>
    <div class="form-group">
        <label class="form-content text-info">アプリケーション</label>
        <select class="form-control" id="appid" name="appid">
            @foreach($datas['applications'] as $app)
            <option value="{{$app->appid}}" @if($app->appid==$datas['appid']) selected @endif>{{$app->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="form-content text-info">ユーザー名</label>
        <input type="text" id="username" name="username" class="form-control @if(!empty($errors->first('username'))) is-invalid @endif" value="{{old('username')}}" placeholder="適用ユーザー名を設定してください。"> 
        <span class="text-danger">{{$errors->first('username')}}</span>
    </div>
    <div class="form-group">
        <label class="form-content text-info">E-MAIL</label>
        <input type="email" id="email" name="email" class="form-control @if(!empty($errors->first('email'))) is-invalid @endif" value="{{old('email')}}" placeholder="Emailを設定してください。"> 
        <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
    <label class="form-content text-info">発行数 (最大登録数 = {{$datas['maxIssuedQuantity']}})</label>
        <input type="number" id="issued-quantity" name="issued-quantity" class="form-control @if(!empty($errors->first('issued-quantity'))) is-invalid @endif" value="{{old('issued-quantity')}}" placeholder="発行数を入力してください。"> 
        <span class="text-danger">{{$errors->first('issued-quantity')}}</span>
    </div>
</form>
@endsection
