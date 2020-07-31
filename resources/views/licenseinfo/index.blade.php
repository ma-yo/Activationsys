@extends('layout.common')
@section('title', 'アクティベーションシステム - ライセンス情報')
@section('css')
<link href="css/licenseinfo-index.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/licenseinfo-index.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')
<p class="text-info h3 h3-title">ライセンス証明書の発行を行います。</p>

<form id="licenseinfo-form" class="form border border-info p-3 rounded" action="" method="post">
    @csrf
    <div class="form-group form-inline">
        @csrf
        <input type="text" id="searchword" name="searchword" class="form-control" value="{{$datas['searchword']}}" 
                placeholder="ユーザー名やメールアドレスを入力してください。"/>
        <button type="button" id="searchlicense-button" name="searchlicense-button" class="btn btn-primary btn-md ml-2 mr-auto">検索</button>
        @if(!empty($datas['licenseinfos']))
            <button type="button" id="licensepdf-button" name="licensepdf-button" class="btn btn-info btn-md ml-2">PDF出力</button>
        @endif
        <button type="button" id="menuback-button" name="menuback-button" class="btn btn-secondary btn-md ml-2">戻る</button>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>選択</th>
                <th>ライセンスID</th>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                <th>アプリケーション</th>
                <th>認証数</th>
                <th>登録日時</th>
                <th>更新日時</th>
            </tr>
        </thead>

        @if(!empty($datas['licenseinfos']))
            <tbody>
                @foreach($datas['licenseinfos'] as $info)
                    <tr>
                        <td>
                            <input type="radio" name="licid"
                            value="{{ $info->licenseid }}" @if($loop->first) checked @endif>
                        </td>
                        <td><small>{{ $info->licenseid }}</small></td>
                        <td><small><input type='hidden' name='username' value='{{ $info->username }}'/>{{ $info->username }}</small></td>
                        <td><small>{{ $info->email }}</small></td>
                        <td><small>{{ $info->appname }}</small></td>
                        <td><small>{{ $info->licensecount }}</small></td>
                        <td><small>{{ $info->created_at }}</small></td>
                        <td><small>{{ $info->updated_at }}</small></td>
                @endforeach
                </tr>
            </tbody>
        @endif
    </table>
</form>
@endsection
