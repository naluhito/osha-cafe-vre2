jQuery(function($) {
    $('#register_form').submit(function() {
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
            if (!name1.match(/^[^\x01-\x7E\xA1-\xDF]+$/)) {
                form.find('#name1-error').text('※全角で入力してください');
                check = false;
            } else {
                form.find('#name1-error').empty();
            }
        }
        var name2 = form.find('#name2').val();
        if (name2 === '') {
            form.find('#name2-error').text('※未入力');
            check = false;
        } else {
            if (!name2.match(/^[^\x01-\x7E\xA1-\xDF]+$/)) {
                form.find('#name2-error').text('※全角で入力してください');
                check = false;
            } else {
                form.find('#name2-error').empty();
            }
        }
        if (check) {
            var name = name1 + name2;
            if (name.length > 20) {
                form.find('#name1-error').text('※姓と名あわせて20文字以内で入力してください');
                check = false;
            }
        }
        var name3 = form.find('#name3').val();
        if (name3 === '') {
            form.find('#name3-error').text('※未入力');
            check = false;
        } else {
            form.find('#name3-error').empty();
        }
        var name4 = form.find('#name4').val();
        if (name4 === '') {
            form.find('#name4-error').text('※未入力');
            check = false;
        } else {
            form.find('#name4-error').empty();
        }
        var zipcode = form.find('#zipcode').val();
        if (zipcode === '') {
            form.find('#zipcode-error').text('※未入力');
            check = false;
        } else {
            form.find('#zipcode-error').empty();
        }
        var pref = form.find('#pref').val();
        if (pref === '') {
            form.find('#pref-error').text('※未選択');
            check = false;
        } else {
            form.find('#pref-error').empty();
        }
        var address1 = form.find('#address1').val();
        if (address1 === '') {
            form.find('#address1-error').text('※未入力');
            check = false;
        } else {
            form.find('#address1-error').empty();
        }
        var address2 = form.find('#address2').val();
        if (address2 === '') {
            form.find('#address2-error').text('※未入力');
            check = false;
        } else {
            form.find('#address2-error').empty();
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
                if (tel.length > 13) {
                    form.find('#name1-error').text('※13文字以内で入力してください');
                    check = false;
                } else {
                    form.find('#tel-error').empty();
                }
            }
        }
        var mail = form.find('#email').val();
        if (mail === '') {
            form.find('#mail-error').text('※未入力');
            check = false;
        } else {
            if (mail.length > 50) {
                form.find('#mail-error').text('※50文字以内で入力してください');
                check = false;
            } else {
                form.find('#mail-error').empty();
            }
        }
        var password = form.find('#password').val();
        var password_confirmation = form.find('#password_confirmation').val();
        if (password !== password_confirmation) {
            form.find('#password-error').text('※パスワード（確認用）と一致しません');
            check = false;
        }
        return check;
    }
});    