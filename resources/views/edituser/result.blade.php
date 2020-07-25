@extends('layout.common')
@section('title', 'アクティベーションシステム - ユーザー情報変更済')
@section('css')
<link href="css/edituser-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/edituser-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="edituser-result">
    <p class="h4 text-dark">ユーザー情報を変更しました。</p>

    <form id="menuback-form" class="form" action="/menu" method="get">
        @csrf
        <div class="form-group form-inline">
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">メニューに戻る</button>
        </div>
    </form>

    <div class="border border-primary rounded p-3 mb-3">
        <table id="resultedituser-table" class="table table-hover">
            <thead>
                <tr>
                    <th>ユーザー名</th>
                    <th>パスワード</th>
                    <th>権限</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
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
                        <td><small>{{ $datas['savedUser'] ->updated_at }}</small></td>
                    </tr>
                </tbody>
            @endif
        </table>
    </div>

    <a style="display: none" id="csvdownload-link" href="#" download=""></a>
</div>


@endsection
