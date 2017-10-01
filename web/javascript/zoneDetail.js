function deleteMode(modeID){
    BootstrapDialog.show({
        title:'提醒',
        message: '確定刪除展項嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function(){
                location='../controller/modeController.php?action=deleteMode&modeID='+ modeID ;
            }
        },{
            label: '取消',
            action: function(dialogItself){
                dialogItself.close();
            }
        }]
    });
}
