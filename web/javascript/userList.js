/**
 * [刪除使用者]
 * @DateTime 2016-09-06
 * @param    {int}   userId [使用者ID]
 * @return   {bool}         [是否成功]
 */
function deleteUser(userId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除使用者嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/userController.php?action=deleteUser&userId=' + userId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
