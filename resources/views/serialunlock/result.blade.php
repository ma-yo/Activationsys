@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアルキーアンロック成功')
@section('css')
<link href="css/serialunlock-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/serialunlock-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="serialunlock-result">
    <p class="h2 h2-title text-primary">シリアルキーのアンロックを行いました。</p>
    <form id="menuback-form" class="form border border-primary rounded p-3 mb-3" action="/menu" method="get">
        @csrf
        <div class="form-group form-inline">
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">メニューに戻る</button>
        </div>

        <table id="resultunlockserial-table" class="table table-hover">
            <thead>
                <tr>
                    <th>シリアルキー</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            @if(!empty($datas['activatedUsers']))
                <tbody>
                    @foreach($datas['activatedUsers'] as $user)
                        <tr>
                            <td><small>{{ $user->serialid }}</small></td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->created_at }}</small></td>
                            <td><small>{{ $user->updated_at }}</small></td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </form>

    <a style="display: none" id="csvdownload-link" href="#" download=""></a>
</div>

@endsection
