$(function(){
    /**
     * シリアルキーを発行する
     */
    $('#genserial').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#genSerialModal').modal('hide');
        $('#genserial-form').attr("method","post");
        $('#genserial-form').attr("action","/createserial");
        $('#genserial-form').submit();
    });
    /**
     * モーダルダイアログを表示する
     */
    $('#modalopen').on('click', function(){
        $('#genSerialModal').modal();
    });
    /**
     * メニュー画面に戻る
     */
    $('#menu').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#genserial-form').attr("method","get");
        $('#genserial-form').attr("action","/menu");
        $('#genserial-form').submit();
    });
});