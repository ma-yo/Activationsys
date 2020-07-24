@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル削除')
@section('css')
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/delserial-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/delserial-index.js"></script>
@endsection

@section('content')

<p class="text-danger h2">シリアル削除を行います。</p>
<p class="text-danger h2">ユーザーはアプリケーションを利用できなくなりますのでご注意ください。</p>

<form id="delserial-form" class="form" action="" method="post">
    @csrf

    <div class="form border border-info p-3 rounded">
        <div class="form-group form-inline">
            <input type="text" id="searchword" name="searchword" class="form-control" value="" style="width:400px;"
                placeholder="名称やE-mailを入力してください。"/>
            <button type="button" id="searchserial" name="searchserial" class="btn btn-primary btn-md ml-2 mr-auto">検索</button>
            @if(!empty($datas['activatedUsers']))
            <button type="button" id="selectall" name="selectall" class="btn btn-primary btn-md ml-2">全件選択</button>
            <button type="button" id="modalopen" class="btn btn-danger btn-md ml-2">シリアル削除</button>
        @endif
        <button type="button" id="menu" name="menu" class="btn btn-secondary btn-md ml-2">戻る</button>
        </div>
        <hr>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>選択</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>シリアルキー</th>
                    <th>デバイスID</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            @if(!empty($datas['activatedUsers']))
                <tbody>
                    @foreach($datas['activatedUsers'] as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="delselect[]"
                                value="{{ $user->serialid }}">
                            </td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->serialid }}</small></td>
                            <td><small>{{ $user->deviceid }}</small></td>
                            <td><small>{{ $user->created_at }}</small></td>
                            <td><small>{{ $user->updated_at }}</small></td>
                    @endforeach
                    </tr>
                </tbody>
            @endif
        </table>

    </div>

</form>

<div class="modal fade" id="delSerialModal" tabindex="-1" role="dialog" aria-labelledby="delSerialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="delSerialModalLabel">シリアルキーの削除</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          選択したシリアルキーを削除しますか？
        </div>
        <div class="modal-footer">
          <button type="button" id="delserial" name="delserial" class="btn btn-danger">シリアル削除</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>

@endsection
