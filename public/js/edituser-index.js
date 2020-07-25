$(function(){

    /**
     * ユーザーリストの変更
     */
    $("#userlist").change(function(){
        Common.showDialog('info', 'progress', 'ユーザー変更中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#edituser-form').attr("method","get");
        $('#edituser-form').attr("action","/changeedituser");
        $('#edituser-form').submit();
    });

    $('#genpassword-button').on('click', function(){
        Common.showDialog('info', 'progress', '強力なパスワードを生成中...','しばらくお待ちください。', null, null);
        $(":button").css('pointer-events','none');
        $('#edituser-form').attr("method","get");
        $('#edituser-form').attr("action","/genpasswordedituser");
        $('#edituser-form').submit();
    });

    $('#setpassword-button').on('click', function(){
        $('#password').val($('#genpassword').html());
        Common.showDialog('info', 'info', 'パスワード適用','パスワードを適用しました。', null, null);
    });
    /**
     * 
    /**
     * ユーザー情報の更新確認
     */
    $('#edituser-button').on('click', function(){
        Common.showDialog('info', 'okcancel', 'ユーザー情報の変更', '入力した内容にてユーザー情報を変更しますか？','更新', null);
    });

    /**
     * ユーザー情報を変更する
     */
    $('#okcancel-modal-ok-button').on('click', function(){
        Common.closeDialog('okcancel');
        Common.showDialog('info', 'progress', 'ユーザー情報変更中...','しばらくお待ちください。', null, null);
        $('#userlist').attr('disabled',false);
        $('#authority').attr('disabled',false);
        $(":button").css('pointer-events','none');
        $('#edituser-form').attr("method","post");
        $('#edituser-form').attr("action","/updateedituser");
        $('#edituser-form').submit();
    });
    /**
     * 
    /**
     * メニュー画面に戻る
     */
    $('#menuback-button').on('click', function(){
        $(":button").css('pointer-events','none');
        $('#edituser-form').attr("method","get");
        $('#edituser-form').attr("action","/menu");
        $('#edituser-form').submit();
    });
});