$(function(){
    $('input[type="submit"]').on('click', function(){

        if($(this).attr('id')=='download-serial'){
            location.href='/downloadcsv';
            return false;
        }
        $('#menu-type').val($(this).attr('name'));
    });

});