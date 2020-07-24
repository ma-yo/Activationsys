$(function () {
    /**
     * シリアルキー発行画面へ移動する
     */
    $('#genserial').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/genserial");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * シリアルキー削除画面へ移動する
     */
    $('#delserial').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/delserial");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });
    /**
     * DBに存在するシリアルキーの一覧をCSV出力する
     */
    $('#downloadserial').on('click', function () {

        $('#progressModal').modal({
            backdrop: 'static',
            keyboard: false
        });

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
            $('#progressModal').modal('hide');
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $('#progressModal').modal('hide');
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました")
            console.log(jqXHR.status);
            console.log(textStatus);
            console.log(errorThrown.message);
        });
    });
});
