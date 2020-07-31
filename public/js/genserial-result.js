$(function () {

    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menuback-form').attr("action", "/menu");
        $('#menuback-form').attr("method", "get");
        $('#menuback-form').submit();
    });

     /**
     * ライセンス証明書の発行を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        
        Common.downloadPdf('/licensepdf','POST',  JSON.stringify({'licid':  $('input[name="licid"]').val()}));

        
    });
    /**
     * モーダルダイアログを開く
     */
    $('#pdfdownload-button').on('click', function(){
        Common.showDialog('info','okcancel','PDF出力','ライセンス証明書PDFを出力しますか？','OK',null);
    });

    /**
     * 作成済みシリアルキーの一覧CSVをダウンロードする
     */
    $('#csvdownload-button').on('click', function () {

        //テーブルの内容をCSVに出力する
        var detailRows = [];
        var headerRows = [];
        $('#resultserial-table tr').each(function (i, e) {
            var detailCols = [];
            var headerCols = [];
            if (i === 0) {
                $(this).find('th').each(function (j, el) {
                    headerCols.push($(this).text());
                })
                headerRows.push(headerCols);
            } else {
                $(this).find('td').each(function (j, el) {
                    detailCols.push($(this).text());
                })
                detailRows.push(detailCols);
            }
        });
        var tableData = $.merge(headerRows, detailRows);

        // BOM の用意（文字化け対策）
        var bomParams = new Uint8Array([0xEF, 0xBB, 0xBF]);

        // CSVデータ
        var csvData = tableData.map(function (l) {
            return l.join(',')
        }).join('\r\n');
        var blobData = new Blob([bomParams, csvData], {
            type: 'text/csv'
        });
        var url = (window.URL || window.webkitURL).createObjectURL(blobData);
        var downloadLink = document.getElementById('csvdownload-link');
        downloadLink.download = Common.formatDate(new Date(), "YYYY-MM-DD-hh-mm-ss") + '-created-serial-list.csv';
        downloadLink.href = url;
        $('#csvdownload-link')[0].click();

    });
});
