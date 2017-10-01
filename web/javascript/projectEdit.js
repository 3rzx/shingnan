$(document).ready(function(){
    $('#isActive').change(function(){
        $('#activeStat').toggleClass('text-success');
        $('#activeStat').toggleClass('text-danger');

        if($('input[name="projectActive"]:checked').length){
            $('#activeStat').html('專案已開啟');
        }else{
            $('#activeStat').html('專案已關閉');
        }
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
    if (fieldValidation('#projectName') && fieldValidation('#projectVersion') && fieldValidation('#projectIntroduction')) {
        return true;
    } else {
        BootstrapDialog.alert('請填寫完整資料');
        return false;
    }
}
