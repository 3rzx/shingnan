<?php
/* Smarty version 3.1.28, created on 2017-09-04 15:21:08
  from "/var/www/html/web/view/project/projectList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59acfee4a7efe5_09123567',
  'file_dependency' => 
  array (
    '658b8766035295d5e88329099c85d806a1112b26' => 
    array (
      0 => '/var/www/html/web/view/project/projectList.html',
      1 => 1473736725,
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
function content_59acfee4a7efe5_09123567 ($_smarty_tpl) {
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
                    <div class="col-xs-12">
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
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">專案列表</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th>專案ID</th>
                                            <th>專案名稱</th>
                                            <th>專案介紹</th>
                                            <th>專案版本</th>
                                            <th>Active</th>
                                            <th>建立時間</th>
                                            <th>最近編輯</th>
                                            <th>操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_project_0_saved_item = isset($_smarty_tpl->tpl_vars['project']) ? $_smarty_tpl->tpl_vars['project'] : false;
$_smarty_tpl->tpl_vars['project'] = new Smarty_Variable();
$__foreach_project_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_project_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['project']->value) {
$__foreach_project_0_saved_local_item = $_smarty_tpl->tpl_vars['project'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['name'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['introduction'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['version'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['active'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['project']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/projectController.php?action=viewProjectDetail&projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
">
                                                    <button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                                </a>&nbsp;
                                                <a href="../controller/projectController.php?action=viewEditForm&projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteProject(<?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
);"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['project'] = $__foreach_project_0_saved_local_item;
}
}
if ($__foreach_project_0_saved_item) {
$_smarty_tpl->tpl_vars['project'] = $__foreach_project_0_saved_item;
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
 src="../javascript/projectList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
