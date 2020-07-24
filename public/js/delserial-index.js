$(function(){

    /**
     * シリアルキーの削除を実行する
     */
    $('#delserial').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#delSerialModal').modal('hide');
        $('#delserial-form').attr("method","post");
        $('#delserial-form').attr("action","/deleteserial");
        $('#delserial-form').submit();
    });
    
    /**
     * モーダルダイアログを開く
     */
    $('#modalopen').on('click', function(){
        if($('input[name="delselect[]"]:checked').length > 0){
            $('#delSerialModal').modal();
        }
    });
    /**
     * 明細行の全選択・全解除を行う
     */
    $('#selectall').on('click', function(){
        if($('input[name="delselect[]"]').eq(0).prop("checked")){
            $('input[name="delselect[]"]').prop("checked", false);
        }else{
            $('input[name="delselect[]"]').prop("checked", true);
        }
    });
    /**
     * シリアルキーの検索を行う
     */
    $('#searchserial').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#delserial-form').attr("method","post");
        $('#delserial-form').attr("action","/searchserial");
        $('#delserial-form').submit();
    });
    /**
     * メニュー画面に戻る
     */
    $('#menu').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#delserial-form').attr("method","get");
        $('#delserial-form').attr("action","/menu");
        $('#delserial-form').submit();
    });
});