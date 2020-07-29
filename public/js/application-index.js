$(function(){
    /**
     * 新規ユーザーを作成する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', 'アプリケーション登録中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#application-form').attr("method","post");
        $('#application-form').attr("action","/applicationcreate");
        $('#application-form').submit();
    });
    /**
     * モーダルダイアログを表示する
     */
    $('#update-button').on('click', function(){
        Common.showDialog('info', 'okcancel', 'アプリケーション登録', '入力した内容にてアプリケーションを登録しますか？','登録', null);
    });
    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#application-form').attr("method","get");
        $('#application-form').attr("action","/menu");
        $('#application-form').submit();
    });
});