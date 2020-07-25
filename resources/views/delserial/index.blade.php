@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル削除')
@section('css')
<link href="css/delserial-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/delserial-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')
<p class="text-danger h2">シリアル削除を行います。</p>
<p class="text-danger h2">ユーザーはアプリケーションを利用できなくなりますのでご注意ください。</p>

<form id="delserial-form" class="form" action="" method="post">
    @csrf
    <div class="form border border-info p-3 rounded">
        <div class="form-group form-inline">
            <input type="text" id="searchword" name="searchword" class="form-control" value="{{$datas['searchword']}}" style="width:400px;"
                    placeholder="名称やE-mailを入力してください。"/>
                <button type="button" id="searchserial-button" name="searchserial-button" class="btn btn-primary btn-md ml-2 mr-auto">検索</button>
                @if(!empty($datas['activatedUsers']))
                <button type="button" id="selectall-button" name="selectall-button" class="btn btn-primary btn-md ml-2">全件選択</button>
                <button type="button" id="delserial-button" name="delserial-button" class="btn btn-info btn-md ml-2">シリアル削除</button>
            @endif
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">戻る</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>選択</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>シリアルキー</th>
                    <th>デバイスID</th>
                    <th>デバイス更新回数</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            @if(!empty($datas['activatedUsers']))
                <tbody>
                    @foreach($datas['activatedUsers'] as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="del-select[]"
                                value="{{ $user->serialid }}">
                            </td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->serialid }}</small></td>
                            <td><small>{{ $user->deviceid }}</small></td>
                            <td><small>{{ $user->devicechangecount }}</small></td>
                            <td><small>{{ $user->created_at }}</small></td>
                            <td><small>{{ $user->updated_at }}</small></td>
                    @endforeach
                    </tr>
                </tbody>
            @endif
        </table>
    </div>
</form>
@endsection
