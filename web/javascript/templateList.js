$(document).ready(function() {
    $('tbody').on("click", ".btn-warning",function(e) {
        e.preventDefault();
        var index = $('.btn-warning').index(this);
        $('.collapse').eq(index).toggle();
    });
});

function deleteTemplate(Id) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除此樣板嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/templateController.php?action=deleteTemplate&id=' + Id;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}