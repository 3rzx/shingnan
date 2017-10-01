<?php
/* Smarty version 3.1.28, created on 2016-11-13 14:57:09
  from "/var/www/html/web/view/template/templateTextList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58280ec5d875c2_76332143',
  'file_dependency' => 
  array (
    '609f40f844ba598b3bba1e67df20ed62e2490f85' => 
    array (
      0 => '/var/www/html/web/view/template/templateTextList.html',
      1 => 1478667554,
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
function content_58280ec5d875c2_76332143 ($_smarty_tpl) {
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
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-10">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['msg']->value != '') {?>
                        <div class="alert alert-success alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-info" >
                            <div class="box-header with-border">
                                    <h3 class="box-title">罐頭文字管理</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-3">罐頭文字</th>
                                            <th class="col-md-3">罐頭文字(英文)</th>
                                            <th class="col-md-2">建立日期</th>
                                            <th class="col-md-2">最後更新</th>
                                            <th class="col-md-1">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['templateData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_template_0_saved_item = isset($_smarty_tpl->tpl_vars['template']) ? $_smarty_tpl->tpl_vars['template'] : false;
$_smarty_tpl->tpl_vars['template'] = new Smarty_Variable();
$__foreach_template_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_template_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['template']->value) {
$__foreach_template_0_saved_local_item = $_smarty_tpl->tpl_vars['template'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_text_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['content'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['content_en'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/templateController.php?action=viewEditText&id=<?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_text_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteText('<?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_text_id'];?>
');"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['template'] = $__foreach_template_0_saved_local_item;
}
}
if ($__foreach_template_0_saved_item) {
$_smarty_tpl->tpl_vars['template'] = $__foreach_template_0_saved_item;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <?php echo '<script'; ?>
 src="../javascript/templateTextList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
