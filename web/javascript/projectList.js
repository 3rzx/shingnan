/**
 * [刪除專案]
 * @DateTime 2016-09-07
 * @param    {int}   projectId [專案ID]
 * @return   {void}
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
