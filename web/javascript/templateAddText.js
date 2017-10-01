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
    if (fieldValidation('#content') && fieldValidation('#contentEn')) {
        return true;
    } else {
        BootstrapDialog.alert('請填寫罐頭文字');
    }

    return false;
}

function clean(){
    $('#content').val('');
    $('#contentEn').val('');
}