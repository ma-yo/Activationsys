@extends('layout.common')
@section('title', 'アクティベーションシステム - シリアル作成成功')
@section('css')
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/genserial-result.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/genserial-result.js"></script>
@endsection

@section('content')

<div id="genserial-result">
    <p class="h4 text-dark">下記シリアルを認証ユーザーへ通知してください。</p>

    <form id="menu-form" class="form" action="/menu" method="get">
        @csrf
        <div class="form-group form-inline">
            <span class="mr-auto"></span>
            <button type="button" id="csvdownload" name="csvdownload" class="btn btn-primary btn-md ml-2">CSV出力</button>
            <button type="button" id="menu" name="menu" class="btn btn-secondary btn-md ml-2">メニューに戻る</button>
        </div>
    </form>

    <div class="border border-primary rounded p-3 mb-3">
        <table id="serial-table" class="table table-hover">
            <thead>
                <tr>
                    <th>シリアルキー</th>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>登録日時</th>
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
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>

    <a style="display: none" id="downloader" href="#" download=""></a>

    <!-- CSV出力用モーダル -->
    <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="progressModalTitle">CSVファイルの出力中...</h5>
                </div>
                <div class="modal-body form-inline mx-auto">
                    <div>しばらくお待ちください。</div>
                    <div class="spinner-border text-primary" style="width: 2rem; height: 2rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
