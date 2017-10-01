<?php
/* Smarty version 3.1.28, created on 2016-10-03 01:48:06
  from "/var/www/html/web/view/lease/leaseAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57f148561fe401_08744863',
  'file_dependency' => 
  array (
    '0f72df92969712f499bb2e7fcaa951af9620eacd' => 
    array (
      0 => '/var/www/html/web/view/lease/leaseAdd.html',
      1 => 1474387293,
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
function content_57f148561fe401_08744863 ($_smarty_tpl) {
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
                                <h3 class="box-title">新增行動導覽裝置</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/leaseController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="padDiv" class="form-group<?php if ($_smarty_tpl->tpl_vars['error']->value == '名稱已被使用') {?> has-error<?php }?>">
                                        <label for="pad_id" class="col-sm-2 control-label">裝置名稱</label>
                                        <div class="col-sm-10">
                                            <input id="pad_id" name="pad_id" type="text" class="form-control" name="pad_id" placeholder="輸入裝置名稱">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a onclick="clean();" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addPad">
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
