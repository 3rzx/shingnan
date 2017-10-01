/**
 * [刪除使用者]
 * @DateTime 2016-09-12
 * @param    {int}   vip_deviceId [使用者ID]
 * @return   {bool}         [是否成功]
 */
function returnVIP(vipDeviceId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定歸還裝置嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/vipDeviceController.php?action=returnVIP&vipDeviceId=' + vipDeviceId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
