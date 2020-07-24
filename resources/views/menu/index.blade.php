@extends('layout.common')
@section('title', 'アクティベーションシステム - メニュー')
@section('css')
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/menu-index.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="js/menu-index.js"></script>
@endsection

@section('content')

<div id="menu">
    <form id="menu-form" class="form" action="{{ url('/menu') }}" method="get">
        @csrf
        <div class="form-group">
            <label for="lic-title" class="h4 text-info">ライセンス管理</label><br>
            <div class="container border border-info p-3 rounded">
                <button type="button" id="genserial" name="genserial" class="btn btn-info btn-lg">シリアル生成</button>
                <button type="button" id="delserial" name="delserial" class="btn btn-info btn-lg">シリアル削除</button>
                <button type="button" id="downloadserial" name="downloadserial" class="btn btn-primary btn-lg">CSV出力</button>
            </div>
        </div>
    </form>

    <!-- CSV出力用モーダル -->
    <div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
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
