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

    <div class="form border border-primary rounded p-3 mb-3">
        <div class="form-group form-inline">
            <p class="h2 h2-title text-primary">ユーザー情報を変更しました。</p>
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
        </div>
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
