<?php
/* Smarty version 3.1.28, created on 2016-10-03 11:40:38
  from "/var/www/html/web/view/lease/leaseList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57f1d3366511b8_61463136',
  'file_dependency' => 
  array (
    '746cac01ef0dc6178f8a885c46bbee55d3634bcf' => 
    array (
      0 => '/var/www/html/web/view/lease/leaseList.html',
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
function content_57f1d3366511b8_61463136 ($_smarty_tpl) {
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
                    <div class="col-xs-7">
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
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                    <h3 class="box-title">裝置硬體管理</h3>
                                    <a href="../controller/leaseController.php?action=viewAddForm">
                                    <button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-plus"></i></button>
                                    </a>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #3c8dbc;color: #fff;">
                                            <th class="col-md-1">ID</th>
                                            <th class="col-md-1">PadID</th>
                                            <th class="col-md-1">借用人</th>
                                            <th class="col-md-1">借用人聯絡電話</th>
                                            <th class="col-md-1">借出時間</th>
                                            <th class="col-md-1">歸還時間</th>
                                            <th class="col-md-1">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['leaseData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_lease_0_saved_item = isset($_smarty_tpl->tpl_vars['lease']) ? $_smarty_tpl->tpl_vars['lease'] : false;
$_smarty_tpl->tpl_vars['lease'] = new Smarty_Variable();
$__foreach_lease_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_lease_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['lease']->value) {
$__foreach_lease_0_saved_local_item = $_smarty_tpl->tpl_vars['lease'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['pad_id'];?>
</td>
                                            <?php if ($_smarty_tpl->tpl_vars['lease']->value['borrower'] == NULL) {?>
                                            <td>未出借</td>
                                            <td>--</td>
                                            <?php } else { ?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['borrower'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['borrower_tel'];?>
</td> 
                                            <?php }?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['lease_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['lease']->value['return_date'];?>
</td>
                                            <td>
                                                <a href="../controller/leaseController.php?action=viewEditPad&id=<?php echo $_smarty_tpl->tpl_vars['lease']->value['id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>
                                                <?php if ($_smarty_tpl->tpl_vars['lease']->value['borrower'] == NULL) {?>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deletePad('<?php echo $_smarty_tpl->tpl_vars['lease']->value['pad_id'];?>
');"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['lease'] = $__foreach_lease_0_saved_local_item;
}
}
if ($__foreach_lease_0_saved_item) {
$_smarty_tpl->tpl_vars['lease'] = $__foreach_lease_0_saved_item;
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
 src="../javascript/leaseList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
