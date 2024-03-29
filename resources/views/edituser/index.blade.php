@extends('layout.common')
@section('title', 'アクティベーションシステム - ユーザー情報編集')
@section('css')
<link href="css/edituser-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/edituser-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<form id="edituser-form" class="form border border-info p-3 rounded" action="/" method="post">
    @csrf
    <div class="form-group form-inline">
        <p class="text-info h4 h4-title">編集情報を入力してください。</p>
        <span class="mr-auto"></span>
        <button type="button" id="edituser-button" name="edituser-button" class="btn btn-info btn-md ml-2">更新</button>
    </div>

    <div class="form-group">
        <label class="form-content text-info">ユーザー名</label>
        <select id="userlist" name="userlist" class="form-control" @if($commons['authority']!="1") disabled  @endif>
            @if($commons['authority']=="1")
            @foreach($datas['allusers'] as $user)
                <option @if($datas['user']->name == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
            @else
                <option selected readonly>{{$datas['user']->name}}</option>
            @endif
        </select>
    </div>
    <div class="form-group">
        <label class="form-content text-info">パスワード</label>
        <div class="form-inline">
            <span id="genpassword" name="genpassword" class="form-control">{{$datas['genpassword']}}</span>
            <button type="button" id="genpassword-button" name="genpassword-button" class="btn btn-info btn-md ml-2">パスワードを作成</button>
            <button type="button" id="setpassword-button" name="setpassword-button" class="btn btn-success ml-2">パスワード適用</button>
        </div>
        <input type="password" id="password" name="password" class="form-control mt-1 @if(!empty($errors->first('password'))) is-invalid @endif" value="{{$datas['user']->password}}" placeholder="パスワードを設定してください。"> 
        <input type="password" id="password2" name="password2" class="form-control mt-1 @if(!empty($errors->first('password2'))) is-invalid @endif" value="{{$datas['user']->password}}" placeholder="確認用パスワードを設定してください。"> 
        <span class="text-danger">{{$errors->first('password')}}</span>
        <span class="text-success h6" id="passwordcheck-message"></span>
    </div>

    <div class="form-group">
        <label class="form-content text-danger">権限</label>
        <select id="authority" name="authority" class="form-control @if(!empty($errors->first('authority'))) is-invalid @endif" @if($commons['authority'] != "1") disabled @endif>
            <option value="1" @if($datas['user']->authority == "1") selected @endif>システム管理者</option>
            <option value="2" @if($datas['user']->authority == "2") selected @endif>一般ユーザー</option>
        </select>
        <span class="text-danger">{{$errors->first('authority')}}</span>
    </div>
    
    <div class="form-group">
        <label class="form-content text-danger">アカウント凍結</label>
        <select id="ban" name="ban" class="form-control @if(!empty($errors->first('ban'))) is-invalid @endif" @if($commons['authority'] != "1") disabled @endif>
            <option value="0" @if($datas['user']->ban == "0") selected @endif>有効</option>
            <option value="1" @if($datas['user']->ban == "1") selected @endif>凍結</option>
        </select>
        <span class="text-danger">{{$errors->first('ban')}}</span>
    </div>

</form>
@endsection
