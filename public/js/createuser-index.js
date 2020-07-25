$(function(){
    /**
     * 新規ユーザーを作成する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', '新規ユーザー作成中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#createuser-form').attr("method","post");
        $('#createuser-form').attr("action","/usercreate");
        $('#createuser-form').submit();
    });
    /**
     * モーダルダイアログを表示する
     */
    $('#createuser-button').on('click', function(){
        Common.showDialog('info', 'okcancel', '新規ユーザー登録', '入力した内容にて新規ユーザー登録しますか？','登録', null);
    });
    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#createuser-form').attr("method","get");
        $('#createuser-form').attr("action","/menu");
        $('#createuser-form').submit();
    });
});