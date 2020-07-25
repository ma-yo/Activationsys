@extends('layout.common')
@section('title', 'アクティベーションシステム - 新規ユーザー作成')
@section('css')
<link href="css/createuser-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/createuser-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<p class="text-dark h2">新規ユーザー情報を入力してください。</p>
<form id="createuser-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        <span class="mr-auto"></span>
        <button type="button" id="createuser-button" name="createuser-button" class="btn btn-info btn-md">新規ユーザー作成</button>
        <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">戻る</button>
    </div>
    <div class="form-group">
        <label class="form-content text-dark">ユーザー名</label>
        <input type="text" id="username" name="username" class="form-control @if(!empty($errors->first('username'))) is-invalid @endif" value="{{old('username')}}" placeholder="ユーザー名を設定してください。"> 
        <span class="text-danger">{{$errors->first('username')}}</span>
    </div>
    <div class="form-group">
        <label class="form-content text-dark">権限</label>
        <select id="authority" name="authority" class="form-control">
            <option value="1">システム管理者</option>
            <option value="2" selected>一般ユーザー</option>
        </select>
    </div>

</form>
@endsection
