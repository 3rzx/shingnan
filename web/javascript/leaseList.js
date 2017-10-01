function returnPad(padId, borrower) {
    BootstrapDialog.show({
        title: '提醒',
        message: borrower + '已歸還行動導覽裝置',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/leaseController.php?action=returnPad&padId=' + padId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}

function deletePad(padId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除行動導覽裝置嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/leaseController.php?action=deletePad&padId=' + padId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}