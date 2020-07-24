@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル作成')
@section('css')
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/genserial-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/genserial-index.js"></script>
@endsection

@section('content')

<p class="text-dark h2">シリアル生成ユーザー情報を入力してください。</p>
<form id="genserial-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        <span class="mr-auto"></span>
        <button type="button" id="modalopen" name="modalopen" class="btn btn-info btn-md">シリアル作成</button>
        <button type="button" id="menu" name="menu" class="btn btn-secondary btn-md ml-2">戻る</button>
    </div>
    <div class="form-group">
        <label class="form-content text-dark">ユーザー名</label>
        <input type="text" id="username" name="username" class="form-control @if(!empty($errors->first('username'))) is-invalid @endif" value="{{old('username')}}" placeholder="適用ユーザー名を設定してください。"> 
        <span class="text-danger">{{$errors->first('username')}}</span>
    </div>
    <div class="form-group">
        <label class="form-content text-dark">E-MAIL</label>
        <input type="email" id="email" name="email" class="form-control @if(!empty($errors->first('email'))) is-invalid @endif" value="{{old('email')}}" placeholder="Emailを設定してください。"> 
        <span class="text-danger">{{$errors->first('email')}}</span>
    </div>
    <div class="form-group">
        <label class="form-content text-dark">発行数</label>
        <input type="number" id="issued-quantity" name="issued-quantity" class="form-control @if(!empty($errors->first('issued-quantity'))) is-invalid @endif" value="{{old('issued-quantity')}}" placeholder="発行数を入力してください。"> 
        <span class="text-danger">{{$errors->first('issued-quantity')}}</span>
    </div>

</form>

<div class="modal fade" id="genSerialModal" tabindex="-1" role="dialog" aria-labelledby="genSerialModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="genSerialModalLabel">シリアルキーの登録</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center align-middle">
          <table>
            <tr>
              <td><i class="fas fa-info-circle fa-2x text-info"></i></td>
              <td class="align-middle"><span class="ml-2">入力した内容にてシリアルキーを登録しますか？</span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" id="genserial" name="genserial" class="btn btn-success">シリアル登録</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>
@endsection
