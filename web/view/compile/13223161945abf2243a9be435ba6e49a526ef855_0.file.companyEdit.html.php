<?php
/* Smarty version 3.1.28, created on 2016-12-14 12:48:25
  from "/var/www/html/web/view/company/companyEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5850cf19727d18_65736577',
  'file_dependency' => 
  array (
    '13223161945abf2243a9be435ba6e49a526ef855' => 
    array (
      0 => '/var/www/html/web/view/company/companyEdit.html',
      1 => 1481690815,
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
function content_5850cf19727d18_65736577 ($_smarty_tpl) {
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯公司</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/companyController.php" enctype="multipart/form-data" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="nameDiv" class="form-group">
                                        <label for="name" class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" class="form-control" placeholder="輸入名稱" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div id="nameEnDiv" class="form-group">
                                        <label for="name" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input id="nameEn" name="nameEn" type="text" class="form-control" placeholder="輸入英文名稱" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['name_en'];?>
">
                                        </div>
                                    </div>
                                    <div id="telDiv" class="form-group">
                                        <label for="tel" class="col-sm-2 control-label">電話</label>
                                        <div class="col-sm-10">
                                            <input id="tel" name="tel" type="text" class="form-control" placeholder="輸入電話" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['tel'];?>
">
                                        </div>
                                    </div>
                                    <div id="faxDiv" class="form-group">
                                        <label for="fax" class="col-sm-2 control-label">傳真</label>
                                        <div class="col-sm-10">
                                            <input id="fax" name="fax" type="text" class="form-control" placeholder="輸入傳真" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['fax'];?>
">
                                        </div>
                                    </div>
                                    <div id="addrDiv" class="form-group">
                                        <label for="addr" class="col-sm-2 control-label">地址</label>
                                        <div class="col-sm-10">
                                            <input id="addr" name="addr" type="text" class="form-control" placeholder="輸入地址" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['addr'];?>
">
                                        </div>
                                    </div>
                                    <div id="webDiv" class="form-group">
                                        <label for="web" class="col-sm-2 control-label">網頁</label>
                                        <div class="col-sm-10">
                                            <input id="web" name="web" type="text" class="form-control" placeholder="輸入網頁" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['web'];?>
">
                                        </div>
                                    </div>
                                    <div id="qrcodeDiv" class="form-group">
                                        <label for="" class="col-sm-2 control-label">QR code</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="oldqrcode" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['qrcode'];?>
">
                                            <input type="file" id="qrcode" name="qrcode" data-input="false">
                                            <img id="qrcodeImg" class="img-thumbnail" alt="QR code" <?php if ($_smarty_tpl->tpl_vars['companyData']->value['qrcode'] == '') {?> style="display:none" <?php } else { ?> src="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['qrcode'];?>
" <?php }?>/>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/companyController.php?action=viewCompanyList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateCompany">
                                    <input type="hidden" name="companyId" value="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['company_id'];?>
">
                                    <button type="submit" class="btn btn-primary">更新</button>
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
 src="../javascript/companyEdit.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
