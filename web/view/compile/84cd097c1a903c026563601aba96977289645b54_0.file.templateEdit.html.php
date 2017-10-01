<?php
/* Smarty version 3.1.28, created on 2016-11-12 15:56:28
  from "/var/www/html/web/view/template/templateEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5826cb2c0f8fb7_93296387',
  'file_dependency' => 
  array (
    '84cd097c1a903c026563601aba96977289645b54' => 
    array (
      0 => '/var/www/html/web/view/template/templateEdit.html',
      1 => 1474258582,
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
function content_5826cb2c0f8fb7_93296387 ($_smarty_tpl) {
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
                                <h3 class="box-title">編輯樣板</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/templateController.php" enctype = "multipart/form-data" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="namerDiv" class="form-group">
                                        <label for="name" class="col-sm-2 control-label">樣板名稱</label>
                                        <div class="col-sm-10">
                                            <input id="name" name="name" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['templateData']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div id="templateDiv" class="form-group">
                                        <label for="template" class="col-sm-2 control-label">樣板</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="template" name="template" data-input="false">
                                            <img id="templateImg" class="img-thumbnail" alt="樣板圖片" src="<?php echo $_smarty_tpl->tpl_vars['templateData']->value['template'];?>
"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/templateController.php?action=viewTemplateList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['templateData']->value['hipster_template_id'];?>
">
                                    <input type="hidden" name="action" value="editTemplate">
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
 src="../javascript/templateEdit.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
