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

    <div class="form border border-primary rounded p-3 mb-3">
        <div class="form-group form-inline">
        <p class="h4 h4-title text-primary">新規ユーザー登録を行いました。</p>
        <span class="mr-auto"></span>
        <button type="button" id="csvdownload-button" name="csvdownload-button" class="btn btn-primary btn-md ml-2">CSV出力</button>
        </div>
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
