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

    $('#settinginfo-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#settinginfo-form').attr("method","post");
        $('#settinginfo-form').attr("action","/updatesettinginfo");
        $('#settinginfo-form').submit();
        Common.showDialog('info', 'progress', 'データ更新中...','しばらくお待ちください。', null, null);
    });

    
});