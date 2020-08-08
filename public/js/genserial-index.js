$(function(){
    /**
     * シリアルキーを発行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', 'シリアル発行中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#genserial-form').attr("method","post");
        $('#genserial-form').attr("action","/createserial");
        $('#genserial-form').submit();
    });
    /**
     * モーダルダイアログを表示する
     */
    $('#genserial-button').on('click', function(){
        Common.showDialog('info', 'okcancel', 'シリアルキーの登録', '入力した内容にてシリアルキーを登録しますか？','シリアル登録', null);
    });
});