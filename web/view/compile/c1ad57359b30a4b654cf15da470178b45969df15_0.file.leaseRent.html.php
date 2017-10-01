<?php
/* Smarty version 3.1.28, created on 2017-08-22 21:53:08
  from "/var/www/html/web/view/lease/leaseRent.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599c37441e7219_69426784',
  'file_dependency' => 
  array (
    'c1ad57359b30a4b654cf15da470178b45969df15' => 
    array (
      0 => '/var/www/html/web/view/lease/leaseRent.html',
      1 => 1473736727,
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
function content_599c37441e7219_69426784 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                    <div class="col-xs-7">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">新增租借</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/leaseController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="borrowerDiv" class="form-group">
                                        <label for="borrower" class="col-sm-2 control-label">租借人</label>
                                        <div class="col-sm-10">
                                            <input id="borrower" name="borrower" type="text" class="form-control" name = "borrower" placeholder="輸入租借人姓名">
                                        </div>
                                    </div>
                                    <div id="telDiv" class="form-group">
                                        <label for="tel" class="col-sm-2 control-label">租借人手機</label>
                                        <div class="col-sm-10">
                                            <input id="tel" name="tel" type="text" class="form-control" name = "tel" placeholder="輸入租借人電話">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="padID" class="col-sm-2 control-label">行動裝置編號</label>
                                        <select name="padID" class="selectpicker col-sm-10">
                                            <?php
$_from = $_smarty_tpl->tpl_vars['padData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_pad_0_saved_item = isset($_smarty_tpl->tpl_vars['pad']) ? $_smarty_tpl->tpl_vars['pad'] : false;
$_smarty_tpl->tpl_vars['pad'] = new Smarty_Variable();
$__foreach_pad_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_pad_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['pad']->value) {
$__foreach_pad_0_saved_local_item = $_smarty_tpl->tpl_vars['pad'];
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['pad']->value['pad_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['pad']->value['pad_id'];?>
</option>
                                            <?php
$_smarty_tpl->tpl_vars['pad'] = $__foreach_pad_0_saved_local_item;
}
}
if ($__foreach_pad_0_saved_item) {
$_smarty_tpl->tpl_vars['pad'] = $__foreach_pad_0_saved_item;
}
?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/userController.php?action=main" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addRent">
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
 src="../javascript/leaseRent.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
