@extends('layout.common')
@section('title', 'アクティベーションシステム - 設定値編集')
@section('css')
<link href="css/settinginfo-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/settinginfo-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="settinginfo">

    <form id="settinginfo-form" class="form border border-info p-3 rounded" action="{{ url('/settinginfo') }}" method="post">
        @csrf
        <div class="form-group form-inline">
            <p class="h4 h4-title text-info">設定値を変更してください。</p>
            <span class="mr-auto"></span>
            <button type="button" id="settinginfo-button" name="settinginfo-button" class="btn btn-info btn-md ml-2">更新</button>
        </div>
        <div class="form-group">
            <label for="serialreset-quantity-label" class="h6">
                <span class="text-info">シリアルキー関連付け回数制限</span>
                <span class="text-danger">※制限を超えてデバイス関連付け解除を行ったユーザーはロックされます。</span>
            </label><br>
            <input type="number" id="serialreset-quantity" name="serialreset-quantity" class="form-control @if(!empty($errors->first('serialreset-quantity'))) is-invalid @endif" value="{{$datas['serialreset']}}" placeholder="最大回数を入力してください。"> 
            <span class="text-danger">{{$errors->first('serialreset-quantity')}}</span>
        </div>
        <div class="form-group">
            <label for="maxsearchrow-label" class="h6 text-info">シリアルID検索結果最大表示行数</label><br>
            <input type="number" id="maxsearchrow-quantity" name="maxsearchrow-quantity" class="form-control @if(!empty($errors->first('maxsearchrow-quantity'))) is-invalid @endif" value="{{$datas['maxsearchrow']}}" placeholder="シリアルキー最大検索行数を入力してください。"> 
            <span class="text-danger">{{$errors->first('maxsearchrow-quantity')}}</span>
        </div>
        <div class="form-group">
            <label for="maxlicenserow-label" class="h6 text-info">ライセンス証明書検索結果最大表示行数</label><br>
            <input type="number" id="maxlicenserow-quantity" name="maxlicenserow-quantity" class="form-control @if(!empty($errors->first('maxlicenserow-quantity'))) is-invalid @endif" value="{{$datas['maxlicenserow']}}" placeholder="証明書最大検索行数を入力してください。"> 
            <span class="text-danger">{{$errors->first('maxlicenserow-quantity')}}</span>
        </div>
        <div class="form-group">
            <label for="maxissued-quantity-label" class="h6 text-info">シリアルキー最大発行数</label><br>
            <input type="number" id="maxissued-quantity" name="maxissued-quantity" class="form-control @if(!empty($errors->first('maxissued-quantity'))) is-invalid @endif" value="{{$datas['maxissued']}}" placeholder="最大登録数を入力してください。"> 
            <span class="text-danger">{{$errors->first('maxissued-quantity')}}</span>
        </div>
    </form>
</div>

@endsection
