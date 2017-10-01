<?php
/* Smarty version 3.1.28, created on 2016-11-17 20:04:55
  from "/var/www/html/web/view/beacon/beaconEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_582d9ce78f4570_57640021',
  'file_dependency' => 
  array (
    '77433c0a2c4498f7ee5ea1a14e45ed91475094e2' => 
    array (
      0 => '/var/www/html/web/view/beacon/beaconEdit.html',
      1 => 1474848090,
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
function content_582d9ce78f4570_57640021 ($_smarty_tpl) {
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
                    <div class="col-md-6">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯Beacon</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/fieldController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="mac_addrDiv" class="form-group<?php if ($_smarty_tpl->tpl_vars['error']->value == '此 Beacon Mac 已登記') {?> has-error<?php }?>">
                                        <label for="mac_addr" class="col-sm-3 control-label">Beacon Mac</label>
                                        <div class="col-sm-9">
                                            <input id="mac_addr" name="mac_addr" type="text" class="form-control" placeholder="輸入 Beacon Mac" value="<?php echo $_smarty_tpl->tpl_vars['beaconData']->value['mac_addr'];?>
">
                                        </div>
                                    </div>
                                    <div id="nameDiv" class="form-group">
                                        <label for="name" class="col-sm-3 control-label">Beacon名稱</label>
                                        <div class="col-sm-9">
                                            <input id="name" name="name" type="text" class="form-control" placeholder="輸入 Beacon名稱" value="<?php echo $_smarty_tpl->tpl_vars['beaconData']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="zone" class="col-sm-3 control-label">隸屬分區編號</label>
                                        <select name="zone" class="selectpicker col-sm-9">
                                            <?php
$_from = $_smarty_tpl->tpl_vars['zoneId']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_id_0_saved_item = isset($_smarty_tpl->tpl_vars['id']) ? $_smarty_tpl->tpl_vars['id'] : false;
$_smarty_tpl->tpl_vars['id'] = new Smarty_Variable();
$__foreach_id_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_id_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value) {
$__foreach_id_0_saved_local_item = $_smarty_tpl->tpl_vars['id'];
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value['zone_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['beaconData']->value['zone'] == $_smarty_tpl->tpl_vars['id']->value['zone_id']) {?>select: selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['id']->value['name'];?>
</option>
                                            <?php
$_smarty_tpl->tpl_vars['id'] = $__foreach_id_0_saved_local_item;
}
}
if ($__foreach_id_0_saved_item) {
$_smarty_tpl->tpl_vars['id'] = $__foreach_id_0_saved_item;
}
?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-3 control-label">紀錄Beacon佈建狀態</label>
                                        <select name="status" class="selectpicker col-sm-9">
                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['beaconData']->value['status'] == 0) {?>select: selected<?php }?>>預設</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['beaconData']->value['status'] == 1) {?>select: selected<?php }?>>未佈置</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['beaconData']->value['status'] == 2) {?>select: selected<?php }?>>待確認</option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['beaconData']->value['status'] == 3) {?>select: selected<?php }?>>已確認</option>
                                        </select>
                                    </div>
                                    <div id="xDiv" class="form-group">
                                        <label for="x" class="col-sm-3 control-label">X座標</label>
                                        <div class="col-sm-9">
                                            <input id="x" name="x" type="text" class="form-control" placeholder="輸入 X座標" value="<?php echo $_smarty_tpl->tpl_vars['beaconData']->value['x'];?>
">
                                        </div>
                                    </div>
                                    <div id="yDiv" class="form-group">
                                        <label for="y" class="col-sm-3 control-label">Y座標</label>
                                        <div class="col-sm-9">
                                            <input id="y" name="y" type="text" class="form-control" placeholder="輸入 Y座標" value="<?php echo $_smarty_tpl->tpl_vars['beaconData']->value['y'];?>
">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/fieldController.php?action=viewFieldDetail&fieldId=<?php echo $_smarty_tpl->tpl_vars['fieldId']->value;?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateBeacon">
                                    <input type="hidden" name="beaconId" value="<?php echo $_smarty_tpl->tpl_vars['beaconData']->value['beacon_id'];?>
">
                                    <button type="submit" class="btn btn-primary">更新</button>
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
 src="../javascript/beaconEdit.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
