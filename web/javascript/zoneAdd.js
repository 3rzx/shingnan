$(document).ready(function() {
    $("#zonePhoto").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#zonePhotoApp").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });

    $("#zoneVoice").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });

    $("#zoneVoiceEn").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });

    $("#zonePhoto").change(function() {
        readURL(this, '#zonePhotoImg');
    });

    $("#zonePhotoApp").change(function() {
        readURL(this, '#zonePhotoAppImg');
    });

    $("#zoneVoice").change(function() {
        readURL(this, '#zoneVoiceAudio');
    });

    $("#zoneVoiceEn").change(function() {
        readURL(this, '#zoneVoiceEnAudio');
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
    if (fieldValidation('#zoneName') && fieldValidation('#zoneIntroduction') && fieldValidation('#zoneNameEn') && fieldValidation('#zoneHint')) {
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
