$(function(){

    /**
     * シリアルキーの凍結解除を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', 'シリアル凍結解除中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#serialunlock-form').attr("method","post");
        $('#serialunlock-form').attr("action","/unlockserial");
        $('#serialunlock-form').submit();
    });
    
    /**
     * モーダルダイアログを開く
     */
    $('#serialunlock-button').on('click', function(){
        if($('input[name="unlock-select[]"]:checked').length > 0){
            Common.showDialog('info','okcancel','シリアルキーの凍結解除','選択したシリアルキーを凍結解除しますか？','解除',null);
        }else{
            Common.showDialog('info','info','シリアルキーの凍結解除','凍結解除するシリアルキーを選択してください。',null,null);
        }
    });
    /**
     * 明細行の全選択・全解除を行う
     */
    $('#selectall-button').on('click', function(){
        if($('input[name="unlock-select[]"]').eq(0).prop("checked")){
            $('input[name="unlock-select[]"]').prop("checked", false);
        }else{
            $('input[name="unlock-select[]"]').prop("checked", true);
        }
    });
    /**
     * シリアルキーの検索を行う
     */
    $('#searchserial-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#serialunlock-form').attr("method","post");
        $('#serialunlock-form').attr("action","/searchlockserial");
        $('#serialunlock-form').submit();
    });
});