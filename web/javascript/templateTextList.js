function deleteText(Id) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除此罐頭文字嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/templateController.php?action=deleteText&id=' + Id;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}

function showTemplate(hipster_template_id) {
    $('#' + hipster_template_id).toggle();
}