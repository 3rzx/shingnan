$(document).ready(function() {
    $('#isActive').change(function() {
        $('#activeStat').toggleClass('text-success');
        $('#activeStat').toggleClass('text-danger');

        if ($('input[name="isActive"]:checked').length) {
            $('#activeStat').html('專案已開啟');
        } else {
            $('#activeStat').html('專案已關閉');
        }
    });
});

/**
 * [刪除專案]
 * @DateTime 2016-09-07
 * @param    {int}   projectId [專案ID]
 */
function deleteProject(projectId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除專案嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/projectController.php?action=deleteProject&projectId=' + projectId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
/**
 * [刪除場域]
 * @DateTime 2016-09-09
 * @param    {int}   fieldId [場域ID]
 */
function deleteField(projectId, fieldId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除場域嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/fieldController.php?action=deleteField&projectId=' + projectId + '&fieldId=' + fieldId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
