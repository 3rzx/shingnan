<?php
/* Smarty version 3.1.28, created on 2016-11-09 12:50:06
  from "/var/www/html/web/view/template/templateEditText.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5822aafece11c7_43370590',
  'file_dependency' => 
  array (
    '1cce86ea0f24645f60132b3271405773b78ee46f' => 
    array (
      0 => '/var/www/html/web/view/template/templateEditText.html',
      1 => 1478666961,
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
function content_5822aafece11c7_43370590 ($_smarty_tpl) {
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
                    <div class="col-md-8">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯罐頭文字</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/templateController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="contentDiv" class="form-group">
                                        <label for="content" class="col-sm-2 control-label">罐頭文字</label>
                                        <div class="col-sm-10">
                                            <textarea id="content" name="content" type="text" class="form-control"><?php echo $_smarty_tpl->tpl_vars['templateData']->value['content'];?>
</textarea>
                                        </div>
                                    </div>
                                    <div id="contentEnDiv" class="form-group">
                                        <label for="contentEn" class="col-sm-2 control-label">罐頭文字(英文)</label>
                                        <div class="col-sm-10">
                                            <textarea id="contentEn" name="contentEn" type="text" class="form-control"><?php echo $_smarty_tpl->tpl_vars['templateData']->value['content_en'];?>
</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/templateController.php?action=viewTextList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['templateData']->value['hipster_text_id'];?>
">
                                    <input type="hidden" name="action" value="editText">
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
 src="../javascript/templateAddText.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
