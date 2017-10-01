<?php
/* Smarty version 3.1.28, created on 2017-08-22 21:53:02
  from "/var/www/html/web/view/company/companyAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599c373ecc18b6_64772481',
  'file_dependency' => 
  array (
    '147726aa6adf939496becc4ae62d35ba12b762a0' => 
    array (
      0 => '/var/www/html/web/view/company/companyAdd.html',
      1 => 1481690814,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/resource.html' => 1,
    'file:../common/header.html' => 1,
    'file:../common/menu.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_599c373ecc18b6_64772481 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"> <?php echo '</script'; ?>
>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1></h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-6">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">新增公司</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/companyController.php" enctype = "multipart/form-data" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="nameDiv" class="form-group">
                                        <label for="name" class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" class="form-control" placeholder="輸入名稱">
                                        </div>
                                    </div>
                                    <div id="nameEnDiv" class="form-group">
                                        <label for="nameEn" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input id="nameEn" name="nameEn" type="text" class="form-control" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div id="telDiv" class="form-group">
                                        <label for="tel" class="col-sm-2 control-label">電話</label>
                                        <div class="col-sm-10">
                                            <input id="tel" name="tel" type="text" class="form-control" placeholder="輸入電話">
                                        </div>
                                    </div>
                                    <div id="faxDiv" class="form-group">
                                        <label for="fax" class="col-sm-2 control-label">傳真</label>
                                        <div class="col-sm-10">
                                            <input id="fax" name="fax" type="text" class="form-control" placeholder="輸入傳真">
                                        </div>
                                    </div>
                                    <div id="addrDiv" class="form-group">
                                        <label for="addr" class="col-sm-2 control-label">地址</label>
                                        <div class="col-sm-10">
                                            <input id="addr" name="addr" type="text" class="form-control" placeholder="輸入地址">
                                        </div>
                                    </div>
                                    <div id="webDiv" class="form-group">
                                        <label for="web" class="col-sm-2 control-label">網頁</label>
                                        <div class="col-sm-10">
                                            <input id="web" name="web" type="text" class="form-control" placeholder="輸入網頁">
                                        </div>
                                    </div>
                                    <div id="qrcodeDiv" class="form-group">
                                        <label for="" class="col-sm-2 control-label">QR code</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="qrcode" name="qrcode" data-input="false">
                                            <img id="qrcodeImg" class="img-thumbnail" style="display:none" alt="QR code"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/companyController.php?action=viewAddForm" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addCompany">
                                    <button type="submit" class="btn btn-primary">確定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <?php echo '<script'; ?>
 src="../javascript/companyAdd.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
