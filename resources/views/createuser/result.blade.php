@extends('layout.common')
@section('title', 'アクティベーションシステム - 新規ユーザー作成成功')
@section('css')
<link href="css/createuser-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/createuser-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="createuser-result">
    <p class="h2 text-primary">新規ユーザー登録を行いました。</p>
    <p class="h2 text-danger">※ユーザー名とパスワードを必ず控えてください。初回ログイン後はパスワードを変更してください。</p>

    <form id="menuback-form" class="form" action="/menu" method="get">
        @csrf
        <div class="form-group form-inline">
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">メニューに戻る</button>
        </div>
    </form>

    <div class="border border-primary rounded p-3 mb-3">
        <table id="resultcreateuser-table" class="table table-hover">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>パスワード</th>
                    <th>権限</th>
                    <th>登録日時</th>
                </tr>
            </thead>
            @if(!empty($datas['savedUser']))
                <tbody>
                    <tr>
                        <td><small>{{ $datas['savedUser'] ->name }}</small></td>
                        <td><small>{{ $datas['savedUser'] ->password }}</small></td>
                        <td><small>
                            @if($datas['savedUser'] ->authority == "1")
                                管理者
                            @elseif($datas['savedUser'] ->authority == "2")
                                一般ユーザー
                            @else
                                ???
                            @endif
                            </small>
                        </td>
                        <td><small>{{ $datas['savedUser'] ->created_at }}</small></td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>

    <a style="display: none" id="csvdownload-link" href="#" download=""></a>
</div>

@endsection
