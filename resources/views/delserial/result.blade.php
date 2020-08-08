@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアルキー削除成功')
@section('css')
<link href="css/delserial-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/delserial-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="delserial-result">
    <div class="form border border-primary rounded p-3 mb-3">
        <div class="form-group form-inline">
            <p class="h4 h4-title text-primary">シリアルキーの削除を行いました。</p>
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
        </div>

        <table id="resultdelserial-table" class="table table-hover">
            <thead>
                <tr>
                    <th>シリアルキー</th>
                    <th>アプリケーション</th>
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
                            <td><small>{{ $user->application->first()->name }}</small></td>
                            <td><small>{{ $user->name }}</small></td>
                            <td><small>{{ $user->email }}</small></td>
                            <td><small>{{ $user->created_at }}</small></td>
                            <td><small>{{ $user->updated_at }}</small></td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>

    <a style="display: none" id="csvdownload-link" href="#" download=""></a>
</div>

@endsection
