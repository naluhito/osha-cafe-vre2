jQuery(function($) {
    $('#back').click(function(){
        location.href='contact';
    });

    $('#send').click(function(){
        location.href='contact_send';
    });

    $('#contact_form').submit(function() {
        $(this).find('#submit').attr("disabled", true);
        if (!validation($(this))) {
            $(this).find('#submit').attr("disabled", false);
            return false;
        }
    });

    function validation(form) {
        var check = true;
        var name1 = form.find('#name1').val();
        if (name1 === '') {
            form.find('#name1-error').text('※未入力');
            check = false;
        } else {
            form.find('#name1-error').empty();
        }
        var name2 = form.find('#name2').val();
        if (name2 === '') {
            form.find('#name2-error').text('※未入力');
            check = false;
        } else {
            form.find('#name2-error').empty();
        }
        var tel = form.find('#tel').val();
        if (tel === '') {
            form.find('#tel-error').text('※未入力');
            check = false;
        } else {
            if(!tel.match(/^[0-9\-]+$/)){
                form.find('#tel-error').text('半角数字とハイフン(-)のみで入力してください');
                check = false;
            } else {
                form.find('#tel-error').empty();
            }
        }
        var mail = form.find('#mail').val();
        if (mail === '') {
            form.find('#mail-error').text('※未入力');
            check = false;
        } else {
            form.find('#mail-error').empty();
        }
        var mail2 = form.find('#mail2').val();
        if (mail2 === '') {
            form.find('#mail2-error').text('※未入力');
            check = false;
        } else {
            form.find('#mail2-error').empty();
        }
        var otoiawase = form.find('#otoiawase').val();
        if (otoiawase === '') {
            form.find('#otoiawase-error').text('※未入力');
            check = false;
        } else {
            form.find('#otoiawase-error').empty();
        }
        if (check) {
            if (mail1 !== mail2) {
                form.find('#mail-error').text('※メールアドレス（確認用）と一致しません');
                check = false;
            }
        }
        return check;
    }
});    