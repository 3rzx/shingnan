/**
 * [刪除使用者]
 * @DateTime 2016-09-06
 * @param    {int}   companyId [CompanyID]
 * @return   {bool}         [是否成功]
 */
function deleteCompany(companyId) {
    BootstrapDialog.show({
        title: '提醒',
        message: '確定刪除公司嗎?',
        buttons: [{
            label: '確定',
            cssClass: 'btn-danger',
            action: function() {
                location = '../controller/companyController.php?action=deleteCompany&companyId=' + companyId;
            }
        }, {
            label: '取消',
            action: function(dialogItself) {
                dialogItself.close();
            }
        }]
    });
}
