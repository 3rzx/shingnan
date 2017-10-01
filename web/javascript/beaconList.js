/**
 * [刪除使用者]
 * @DateTime 2016-09-06
 * @param    {int}   beaconId [BeaconID]
 * @return   {bool}         [是否成功]
 */
function deleteBeacon(beaconId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除Beacon嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/beaconController.php?action=deleteBeacon&beaconId=' + beaconId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
