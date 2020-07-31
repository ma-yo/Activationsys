@extends('layout.common')
@section('title', 'アクティベーションシステム - 設定値編集済')
@section('css')
<link href="css/settinginfo-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/settinginfo-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="settinginfo-result">
    <p class="h2 h2-title text-primary">設定情報を変更しました。</p>

    <form id="menuback-form" class="form border border-primary rounded p-3 mb-3" action="/menu" method="get">
        @csrf
        <div class="form-group form-inline">
            <span class="mr-auto"></span>
            <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">メニューに戻る</button>
        </div>

        <table id="resultsettinginfo-table" class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>プロパティ</th>
                    <th>値</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            @if(!empty($datas['settinginfos']))
                <tbody>
                    @foreach($datas['settinginfos'] as $settinginfo)
                        <tr>
                            <td><small>{{ $settinginfo->settingid }}</small></td>
                            <td><small>{{ $settinginfo->description }}</small></td>
                            <td><small>{{ $settinginfo->value1 }}</small></td>
                            <td><small>{{ $settinginfo->created_at }}</small></td>
                            <td><small>{{ $settinginfo->updated_at }}</small></td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>

    </form>
</div>


@endsection
