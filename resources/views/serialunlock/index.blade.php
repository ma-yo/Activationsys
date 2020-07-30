@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル凍結解除')
@section('css')
<link href="css/serialunlock-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/serialunlock-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')
<p class="text-info h2 h2-title">シリアル凍結解除を行います。</p>
<p class="text-info h2 h2-title">ユーザーはアプリケーションを再度利用できるようになります。</p>

<form id="serialunlock-form" class="form" action="" method="post">
    @csrf
    <div class="form border border-info p-3 rounded">
        <div class="form-group form-inline">
            <input type="text" id="searchword" name="searchword" class="form-control" value="{{$datas['searchword']}}"
                    placeholder="名称やE-mail,シリアルキーを入力してください。"/>
            <button type="button" id="searchserial-button" name="searchserial-button" class="btn btn-primary btn-md ml-2 mr-auto">検索</button>
            @if(!empty($datas['activatedUsers']))
                <button type="button" id="selectall-button" name="selectall-button" class="btn btn-primary btn-md ml-2">全件選択</button>
                <button type="button" id="serialunlock-button" name="serialunlock-button" class="btn btn-info btn-md ml-2">アンロック解除</button>
            @endif
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">戻る</button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>選択</th>
                    <th>アプリケーション</th>
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
                                <input type="checkbox" name="unlock-select[]"
                                value="{{ $user->serialid }}">
                            </td>
                            <td><small>{{ $user->application->first()->name }}</small></td>
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
