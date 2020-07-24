$(function(){
    /**
     * ログインを実行する
     */
    $('#login-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#login-form').attr("action","/login");
        $('#login-form').attr("method","post");
        $('#login-form').submit();
    });
});