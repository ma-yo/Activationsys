$(function(){

    /**
     * ライセンス証明書の発行を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.downloadPdf('/licensepdf','POST',  JSON.stringify({'licid':  $('input[name="licid"]:checked').val()}));
    });
    /**
     * モーダルダイアログを開く
     */
    $('#licensepdf-button').on('click', function(){
        Common.showDialog('info','okcancel','PDF出力','ライセンス証明書PDFを出力しますか？','OK',null);
    });

    $('#searchlicense-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#licenseinfo-form').attr("method","post");
        $('#licenseinfo-form').attr("action","/searchlicense");
        $('#licenseinfo-form').submit();
    });
    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#licenseinfo-form').attr("method","get");
        $('#licenseinfo-form').attr("action","/menu");
        $('#licenseinfo-form').submit();
    });

    
});