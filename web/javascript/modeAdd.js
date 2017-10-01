$(document).ready(function() {
    $("#modeBG").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeBGVertical").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeBGVerticalEn").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeFG").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeFGVertical").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeBL").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeBLVertical").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳圖片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-camera"
    });
    $("#modeVideo").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳影片",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-film"
    });
    $("#modeGuideVoice").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳導覽語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });
    $("#modeGuideVoiceEn").filestyle({
        size: "nr",
        input: false,
        buttonText: "上傳導覽語音",
        buttonName: "btn-success",
        iconName: "glyphicon glyphicon-music"
    });
    $("#modeBG").change(function() {
        readURL(this, '#modeBGImg');
    });
    $("#modeBGVertical").change(function() {
        readURL(this, '#modeBGVerticalImg');
    });
    $("#modeFG").change(function() {
        readURL(this, '#modeFGImg');
    });
    $("#modeFGVertical").change(function() {
        readURL(this, '#modeFGVerticalImg');
    });
    $("#modeBL").change(function() {
        readURL(this, '#modeBLImg');
    });
    $("#modeBLVertical").change(function() {
        readURL(this, '#modeBLVerticalImg');
    });
    $("#modeGuideVoice").change(function() {
        readURL(this, '#modeGuideVoiceAudio');
    });
    $("#modeGuideVoiceEn").change(function() {
        readURL(this, '#modeGuideVoiceEnAudio');
    });
    $("#modeVideo").change(function() {
        readURL(this, '#modeVideoVideo');
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
    if (fieldValidation('#modeName') && fieldValidation('#modeIntroduction')) {
        return true;
    } else {
        BootstrapDialog.alert('請至少填寫名字與介紹資料');
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
