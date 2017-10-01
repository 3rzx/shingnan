$(document).ready(function(){
    $('#isActive').change(function(){
        $('#activeStat').toggleClass('text-success');
        $('#activeStat').toggleClass('text-danger');

        if($('input[name="isActive"]:checked').length){
            $('#activeStat').html('專案已開啟');
        }else{
            $('#activeStat').html('專案已關閉');
        }
    });
});

/**
 * [刪除區域]
 * @DateTime 2016-09-12
 * @param    {int}   fieldId [場域ID]
 * @param    {int}   zoneId  [區域ID]
 * @return   {void}
 */
function deleteZone(fieldId, zoneId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除區域嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/zoneController.php?action=deleteZone&fieldId=' + fieldId + '&zoneId=' + zoneId;
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
 * [刪除Beacon]
 * @DateTime 2016-09-06
 * @param    {int}   beaconId [BeaconID]
 * @return   {bool}           [是否成功]
 */
function deleteBeacon(fieldId, beaconId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除Beacon嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/fieldController.php?action=deleteBeacon&fieldId=' + fieldId + '&beaconId=' + beaconId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
