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
    /**
     * 強力なパスワードを生成する
     */
    $('#genpassword-button').on('click', function(){
        Common.showDialog('info', 'progress', '強力なパスワードを生成中...','しばらくお待ちください。', null, null);
        $('#userlist').attr('disabled',false);
        $('#authority').attr('disabled',false);
        $(":button").css('pointer-events','none');
        $('#edituser-form').attr("method","get");
        $('#edituser-form').attr("action","/genpasswordedituser");
        $('#edituser-form').submit();
    });
    /**
     * パスワードを適用する
     */
    $('#setpassword-button').on('click', function(){
        $('#password').val($('#genpassword').html());
        $('#password2').val($('#genpassword').html());
        Common.showDialog('info', 'info', 'パスワード適用','パスワードを適用しました。', null, null);
    });
    /**
     * パスワード入力チェック
     */
    $('#password, #password2').on('change', function(){
        
        $('#passwordcheck-message').removeClass('text-danger');
        $('#passwordcheck-message').removeClass('text-success');
        if($('#password').val() ==''
        ||$('#password2').val() ==''){
            $('#passwordcheck-message').html('※パスワード又は、パスワード確認用を入力してください。');
            $('#passwordcheck-message').addClass('text-danger');
            return;
        }
        if($('#password').val() != $('#password2').val()){
            $('#passwordcheck-message').html('※パスワードは一致していません。');
            $('#passwordcheck-message').addClass('text-danger');
            return;
        }
        if($('#password').val() == $('#password2').val()){
            $('#passwordcheck-message').html('※パスワードは一致しています。');
            $('#passwordcheck-message').addClass('text-success');
            return;
        }
    });

    /**
     * ユーザー情報の更新確認
     */
    $('#edituser-button').on('click', function(){
        if($('#password').val() != $('#password2').val()){
            Common.showDialog('warning', 'info','パスワード不一致', 'パスワードは一致していません。',null, null);
            return;
        }
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