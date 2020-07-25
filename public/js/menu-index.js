$(function () {
    /**
     * シリアルキー発行画面へ移動する
     */
    $('#genserial-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/genserial");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * 設定マスタ画面へ移動する
     */
    $('#settinfinfo-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/settinginfo");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * シリアルキー削除画面へ移動する
     */
    $('#delserial-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/delserial");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * シリアルキー凍結解除画面へ移動する
     */
    $('#serialunlock-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/serialunlock");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * 新規ユーザ作成画面へ移動する
     */
    $('#createuser-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/createuser");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * ユーザ編集画面へ移動する
     */
    $('#edituser-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/edituser");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    
    /**
     * シリアルキー一覧CSVを出力する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', 'CSVファイルの出力中...','しばらくお待ちください。', null, null);

        if($('#menu-action').val() == 'downloadserial'){
            //出力が早すぎるとモーダルダイアログが閉じないため、対応する
            Common.sleep(1000, function(){
                //非同期処理にてCSVをダウンロードする
                $.ajax({
                    type: 'get',
                    url: 'downloadseriallistcsv',
                    dataType: 'text'
                }).done(function (response) {

                    let rt = response;
                    strRt = Encoding.stringToCode(rt);
                    arrRt = Encoding.convert(strRt, "sjis", "unicode");
                    u8a = new Uint8Array(arrRt);
                    blob = new Blob([u8a], {
                        'type': 'text/csv;charset=sjis;'
                    });
                    blobUrl = window.URL.createObjectURL(blob);
                    a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = Common.formatDate(new Date(), "YYYY-MM-DD-hh-mm-ss") + '-serial-list.csv';
                    a.click();

                    Common.closeDialog(null);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    Common.closeDialog(null);
                    alert('ファイルの取得に失敗しました。');
                    console.log("ajax通信に失敗しました")
                    console.log(jqXHR.status);
                    console.log(textStatus);
                    console.log(errorThrown.message);
                }); 
            });
            return;
        }

        if($('#menu-action').val() == 'downloaduser'){
            //出力が早すぎるとモーダルダイアログが閉じないため、対応する
            Common.sleep(1000, function(){
                //非同期処理にてCSVをダウンロードする
                $.ajax({
                    type: 'get',
                    url: 'downloaduserlistcsv',
                    dataType: 'text'
                }).done(function (response) {

                    let rt = response;
                    strRt = Encoding.stringToCode(rt);
                    arrRt = Encoding.convert(strRt, "sjis", "unicode");
                    u8a = new Uint8Array(arrRt);
                    blob = new Blob([u8a], {
                        'type': 'text/csv;charset=sjis;'
                    });
                    blobUrl = window.URL.createObjectURL(blob);
                    a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = Common.formatDate(new Date(), "YYYY-MM-DD-hh-mm-ss") + '-user-list.csv';
                    a.click();

                    Common.closeDialog(null);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    Common.closeDialog(null);
                    alert('ファイルの取得に失敗しました。');
                    console.log("ajax通信に失敗しました")
                    console.log(jqXHR.status);
                    console.log(textStatus);
                    console.log(errorThrown.message);
                }); 
            });
            return;
        }
    });

    /**
     * CSV一覧出力確認ダイアログを表示する
     */
    $('#downloadserial-button').on('click', function () {
        Common.showDialog('info', 'okcancel', '一覧CSV出力', '全ての登録情報をCSV出力しますか？','CSV出力', null);
        $('#menu-action').val('downloadserial');
    });

    $('#downloaduser-button').on('click', function () {
        Common.showDialog('info', 'okcancel', 'ユーザー一覧CSV出力', 'ユーザー一覧CSVを出力しますか？','CSV出力', null);
        $('#menu-action').val('downloaduser');
    });
});
