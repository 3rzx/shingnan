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
    if (fieldValidation('#pad_id')) {
        return true;
    } else {
        BootstrapDialog.alert('請填編號');
    }

    return false;
}

function clean(){
    $('#pad_id').val('');
}
