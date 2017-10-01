function fieldValidation(field) {
    if ($.trim($(field).val()) == '') {
        $(field + 'Div').addClass('has-error');
        $(field + 'Div').val('');
        return false;
    } else {
        $(field + 'Div').removeClass('has-error');
    }
    return true;
}

function formValidation() {
    if (fieldValidation('#email') && fieldValidation('#password') && fieldValidation('#repeatPassword')) {
        var password = $('#passwordDiv input').val();
        var repeatPassword = $('#repeatPasswordDiv input').val();
        if (password == repeatPassword) {
            return true;
        } else {
            $('#repeatPasswordDiv').addClass('has-error');
            BootstrapDialog.alert('兩次密碼輸入不一樣');
        }
    } else {
        BootstrapDialog.alert('請填寫完整資料');
    }

    return false;
}
