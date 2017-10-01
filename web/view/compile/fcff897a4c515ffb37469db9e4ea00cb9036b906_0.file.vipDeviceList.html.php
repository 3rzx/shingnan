<?php
/* Smarty version 3.1.28, created on 2017-08-22 22:01:30
  from "/var/www/html/web/view/vipDevice/vipDeviceList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599c393a41da83_80852526',
  'file_dependency' => 
  array (
    'fcff897a4c515ffb37469db9e4ea00cb9036b906' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipDeviceList.html',
      1 => 1480561713,
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
function content_599c393a41da83_80852526 ($_smarty_tpl) {
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
                        <div class="box">
                        	<div class="box-header">
                                <h3 class="box-title">貴賓證列表</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th>貴賓證編號</th>
                                            <th>貴賓證識別碼</th>
                                            <th>裝置電量</th>
                                            <th>使用者姓名</th>
                                            <th>操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['vipDeviceData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vip_0_saved_item = isset($_smarty_tpl->tpl_vars['vip']) ? $_smarty_tpl->tpl_vars['vip'] : false;
$_smarty_tpl->tpl_vars['vip'] = new Smarty_Variable();
$__foreach_vip_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_vip_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['vip']->value) {
$__foreach_vip_0_saved_local_item = $_smarty_tpl->tpl_vars['vip'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_hu_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['vip']->value['mac_addr'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['vip']->value['power'];?>
</td>
                                            <?php if ($_smarty_tpl->tpl_vars['vip']->value['name'] == NULL) {?>
                                            <td>無</td>
                                            <?php } else { ?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['vip']->value['name'];?>
</td>
                                            <?php }?>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['vip']->value['name'] == NULL) {?>
                                                <a href="../controller/vipDeviceController.php?action=viewVIPSetForm&vipDeviceId=<?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_id'];?>
">
                                                    <button class="btn btn-sm btn-success">租借</button>
                                                    <a href="../controller/vipDeviceController.php?action=viewVIPEditForm&vipDeviceId=<?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_id'];?>
">
                                                        <button class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></button>
                                                    </a>
                                                    <a href="../controller/vipDeviceController.php?action=deleteVIPDevice&vipDeviceId=<?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_id'];?>
">
                                                        <button class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                                                    </a>
                                                </a>
                                                <?php } else { ?>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="returnVIP(<?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_id'];?>
);">歸還</button>
                                                    <a href="../controller/vipDeviceController.php?action=viewVIPEditForm&vipDeviceId=<?php echo $_smarty_tpl->tpl_vars['vip']->value['vip_device_id'];?>
">
                                                        <button class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></button>
                                                    </a>
                                                </a>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['vip'] = $__foreach_vip_0_saved_local_item;
}
}
if ($__foreach_vip_0_saved_item) {
$_smarty_tpl->tpl_vars['vip'] = $__foreach_vip_0_saved_item;
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
 src="../javascript/vipDeviceList.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
