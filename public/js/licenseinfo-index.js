$(function(){

    /**
     * ライセンス証明書の発行を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        $('input[name="licid[]"]:checked').map(function(){
            Common.downloadPdf('/licensepdf','POST',  JSON.stringify({'licid':  $(this).val()}), 500);
        });
    });
    /**
     * モーダルダイアログを開く
     */
    $('#licensepdf-button').on('click', function(){
        Common.showDialog('info','okcancel','PDF出力','ライセンス証明書PDFを出力しますか？','OK',null);
    });
    /**
     * 明細行の全選択・全解除を行う
     */
    $('#selectall-button').on('click', function(){
        if($('input[name="licid[]"]').eq(0).prop("checked")){
            $('input[name="licid[]"]').prop("checked", false);
        }else{
            $('input[name="licid[]"]').prop("checked", true);
        }
    });
    /**
     * ライセンスを検索する
     */
    $('#searchlicense-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#licenseinfo-form').attr("method","post");
        $('#licenseinfo-form').attr("action","/searchlicense");
        $('#licenseinfo-form').submit();
    });
});