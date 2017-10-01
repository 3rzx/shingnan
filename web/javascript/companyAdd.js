$(document).ready(function() {
    $(":file").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#qrcode").change(function() {
        readURL(this, '#qrcodeImg');
    });
});

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
    if (fieldValidation('#name') && fieldValidation('#tel')) {
        return true;
    } else {
        BootstrapDialog.alert('請填寫完整資料');
    }

    return false;
}

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(id).attr('src', e.target.result);
        }
        $(id).css('display', '');
        reader.readAsDataURL(input.files[0]);
    }
}