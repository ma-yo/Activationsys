$(function(){

    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#settinginfo-form').attr("method","get");
        $('#settinginfo-form').attr("action","/menu");
        $('#settinginfo-form').submit();
    });

    /**
     * 設定情報の更新を実行する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', '設定情報更新中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#settinginfo-form').attr("method","post");
        $('#settinginfo-form').attr("action","/updatesettinginfo");
        $('#settinginfo-form').submit();
    });

    $('#settinginfo-button').on('click', function(){
        Common.showDialog('info', 'okcancel', '設定情報編集', '入力した内容にて設定情報を変更しますか？','更新', null);
    });

    
});