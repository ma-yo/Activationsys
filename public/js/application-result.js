$(function () {

    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function () {
        $(":button").css('pointer-events', 'none');
        $('#menuback-form').attr("action", "/menu");
        $('#menuback-form').attr("method", "get");
        $('#menuback-form').submit();
    });
});
