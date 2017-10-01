<?php
/* Smarty version 3.1.28, created on 2016-10-03 01:53:02
  from "/var/www/html/web/view/lease/leaseEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57f1497e6702c0_50278919',
  'file_dependency' => 
  array (
    'ba6d3a6dba9b7dc3ac50dfe8a2ceaf02fb041f40' => 
    array (
      0 => '/var/www/html/web/view/lease/leaseEdit.html',
      1 => 1473736726,
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
function content_57f1497e6702c0_50278919 ($_smarty_tpl) {
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯行動導覽裝置</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/leaseController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="padDiv" class="form-group<?php if ($_smarty_tpl->tpl_vars['error']->value == '編號已被使用') {?> has-error<?php }?>">
                                        <label for="pad_id" class="col-sm-2 control-label">裝置名稱</label>
                                        <div class="col-sm-10">
                                            <input id="pad_id" name="pad_id" type="text" class="form-control" name="pad_id" placeholder="輸入裝置名稱" value="<?php echo $_smarty_tpl->tpl_vars['leaseData']->value['pad_id'];?>
">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/leaseController.php?action=viewLeaseList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['leaseData']->value['id'];?>
">
                                    <input type="hidden" name="action" value="EditPad">
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
 src="../javascript/leaseAdd.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
