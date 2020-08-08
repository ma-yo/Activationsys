@extends('layout.common')
@section('title', 'アクティベーションシステム - アプリケーション登録済')
@section('css')
<link href="css/application-result.css?{{$commons['systemdate']}}" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/application-result.js?{{$commons['systemdate']}}"></script>
@endsection

@section('content')

<div id="application-result">
    <div class="border border-info p-3 rounded" action="" method="post">
        <p class="h4 h4-title text-primary">アプリケーション登録を行いました。</p>
        <table id="resultapplication-table" class="table table-hover">
            <thead>
                <tr>
                    <th>アプリケーションID</th>
                    <th>アプリケーション名</th>
                    <th>登録日時</th>
                    <th>更新日時</th>
                </tr>
            </thead>
            @if(!empty($datas['applications']))
                <tbody>
                    @foreach($datas['applications'] as $key => $app)
                        <tr>
                        <td><small>{{ $app->appid }}</small></td>
                            <td><small>{{ $app->name }}</small></td>
                            <td><small>{{ $app->created_at }}</small></td>
                            <td><small>{{ $app->updated_at }}</small></td>
                    @endforeach
                    </tr>
                </tbody>
            @endif
        </table>
    </div>  
</div>
@endsection
