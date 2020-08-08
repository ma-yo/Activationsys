$(function () {

    /**
     * 作成済みシリアルキーの一覧CSVをダウンロードする
     */
    $('#csvdownload-button').on('click', function () {
        //テーブルの内容をCSVに出力する
        var detailRows = [];
        var headerRows = [];
        $('#resultcreateuser-table tr').each(function (i, e) {
            var detailCols = [];
            var headerCols = [];
            if (i === 0) {
                $(this).find('th').each(function (j, el) {
                    headerCols.push($(this).text().trim());
                })
                headerRows.push(headerCols);
            } else {
                $(this).find('td').each(function (j, el) {
                    detailCols.push($(this).text().trim());
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
        //ダウンロードリンクを作成する
        var url = (window.URL || window.webkitURL).createObjectURL(blobData);
        var downloadLink = document.getElementById('csvdownload-link');
        downloadLink.download = Common.formatDate(new Date(), "YYYY-MM-DD-hh-mm-ss") + '-created-user.csv';
        downloadLink.href = url;
        $('#csvdownload-link')[0].click();

    });
});
