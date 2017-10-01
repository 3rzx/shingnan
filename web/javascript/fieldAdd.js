$(document).ready(function() {
    $("#fieldPhoto").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#fieldPhotoApp").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#fieldMap").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#fieldMapEn").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#fieldMapBg").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#fieldPhoto").change(function() {
        readURL(this, '#fieldPhotoImg');
    });

    $("#fieldPhotoApp").change(function() {
        readURL(this, '#fieldPhotoAppImg');
    });

    $("#fieldMap").change(function() {
        readURL(this, '#fieldMapImg');
    });

    $("#fieldMapEn").change(function() {
        readURL(this, '#fieldMapEnImg');
    });

    $("#fieldMapBg").change(function() {
        readURL(this, '#fieldMapBgImg');
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
    if (fieldValidation('#fieldName') && fieldValidation('#fieldIntroduction') && fieldValidation('#fieldNameEn')) {
        return true;
    } else {
        BootstrapDialog.alert('請填寫完整資料');
        return false;
    }
}

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $(id).attr('src', e.target.result);
            $(id).css('display', '');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
