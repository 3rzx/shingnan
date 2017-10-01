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
    if (fieldValidation('#borrower') && fieldValidation('#tel')) {
        return true;
    } else {
        BootstrapDialog.alert('請填寫完整資訊');
    }

    return false;
}