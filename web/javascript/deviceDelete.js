function deleteDevice(deviceID){
    BootstrapDialog.show({
        title:'提醒',
        message: '確定刪除裝置嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function(){
                location='../controller/deviceController.php?action=deleteDevice&deviceID='+ deviceID ;
            }
        },{
            label: '取消',
            action: function(dialogItself){
                dialogItself.close();
            }
        }]
    });
}
