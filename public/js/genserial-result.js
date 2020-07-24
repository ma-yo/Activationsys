$(function () {

    /**
     * メニュー画面に戻る
     */
    $('#menu').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menu-form').attr("action", "/menu");
        $('#menu-form').attr("method", "get");
        $('#menu-form').submit();
    });

    /**
     * 作成済みシリアルキーの一覧CSVをダウンロードする
     */
    $('#csvdownload').on('click', function () {

        //テーブルの内容をCSVに出力する
        var detailRows = [];
        var headerRows = [];
        $('#serial-table tr').each(function (i, e) {
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
        var downloadLink = document.getElementById('downloader');
        downloadLink.download = Common.formatDate(new Date(), "YYYY-MM-DD-hh-mm-ss") + '-created-serial-list.csv';
        downloadLink.href = url;
        $('#downloader')[0].click();

    });
});
