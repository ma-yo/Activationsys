$(function(){

    /**
     * シリアルキーの削除を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('danger', 'progress', 'シリアル削除中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#delserial-form').attr("method","post");
        $('#delserial-form').attr("action","/deleteserial");
        $('#delserial-form').submit();
    });
    
    /**
     * モーダルダイアログを開く
     */
    $('#delserial-button').on('click', function(){
        if($('input[name="del-select[]"]:checked').length > 0){
            Common.showDialog('danger','okcancel','シリアルキーの削除','選択したシリアルキーを削除しますか？','削除',null);
        }else{
            Common.showDialog('info','info','シリアルキーの削除','削除するシリアルキーを選択してください。',null,null);
        }
    });
    /**
     * 明細行の全選択・全解除を行う
     */
    $('#selectall-button').on('click', function(){
        if($('input[name="del-select[]"]').eq(0).prop("checked")){
            $('input[name="del-select[]"]').prop("checked", false);
        }else{
            $('input[name="del-select[]"]').prop("checked", true);
        }
    });
    /**
     * シリアルキーの検索を行う
     */
    $('#searchserial-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#delserial-form').attr("method","post");
        $('#delserial-form').attr("action","/searchserial");
        $('#delserial-form').submit();
    });
});