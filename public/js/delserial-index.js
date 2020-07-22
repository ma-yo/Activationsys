$(function(){
    $('#delserial').on('click', function(){
        if(!confirm('選択しているシリアルを本当に削除しますか？')){
            return false;
        }else{
            return true;
        }
    });
    $('input[type="submit"]').on('click', function(){
        $('#content').val($(this).attr('name'));
    });
    $( 'input[name="delselect"]:radio' ).change( function() {
        $('#delserialid').val($(this).val());
    });
        
});