$(function(){
    $('input[type="submit"]').on('click', function(){
        $('#content').val($(this).attr('name'));
    });
});