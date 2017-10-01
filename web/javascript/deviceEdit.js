$(document).ready(function() {
    $("#devicePhoto").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#devicePhotoVertical").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#deviceGuideVoice").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳導覽語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });
    $("#deviceGuideVoiceEn").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳導覽語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });
    $("#devicePhoto").change(function() {
        readURL(this, '#devicePhotoImg');
    });
    $("#devicePhotoVertical").change(function() {
        readURL(this, '#devicePhotoVerticalImg');
    });
    $("#deviceGuideVoice").change(function() {
        readURL(this, '#deviceGuideVoiceAudio');
    });
    $("#deviceGuideVoiceEn").change(function() {
        readURL(this, '#deviceGuideVoiceEnAudio');
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
    if (fieldValidation('#deviceName') && fieldValidation('#deviceIntroduction') && fieldValidation('#deviceMode') && fieldValidation('#deviceCompany')) {
        return true;
    } else {
        BootstrapDialog.alert('請至少填寫名字、介紹資料、隸屬展項與提供廠商');
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
