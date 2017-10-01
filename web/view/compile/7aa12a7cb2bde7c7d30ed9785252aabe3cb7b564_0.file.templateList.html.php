<?php
/* Smarty version 3.1.28, created on 2016-11-22 14:49:40
  from "/var/www/html/web/view/template/templateList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5833ea84b1aea6_36583435',
  'file_dependency' => 
  array (
    '7aa12a7cb2bde7c7d30ed9785252aabe3cb7b564' => 
    array (
      0 => '/var/www/html/web/view/template/templateList.html',
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
function content_5833ea84b1aea6_36583435 ($_smarty_tpl) {
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
                    <div class="col-md-8">
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
                                    <h3 class="box-title">文青樣板管理</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-2">樣板名稱</th>
                                            <th class="col-md-1">樣板</th>
                                            <th class="col-md-3">建立時間</th>
                                            <th class="col-md-3">最後更新</th>
                                            <th class="col-md-2">操作選項</th>
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
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_template_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['name'];?>
</td>
                                            <td>
                                                <a href="#">
                                                    <button id="showBtn" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-picture"></i></button>
                                                </a>
                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['create_date'];?>
</td> 
                                            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/templateController.php?action=viewEditForm&id=<?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_template_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteTemplate('<?php echo $_smarty_tpl->tpl_vars['template']->value['hipster_template_id'];?>
');"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="showPic" class="collapse">
                                            <td colspan="6">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['template']->value['template'];?>
" width="100%" />
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
 src="../javascript/templateList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
