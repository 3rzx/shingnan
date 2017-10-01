<?php
/* Smarty version 3.1.28, created on 2016-12-08 14:10:24
  from "/var/www/html/web/view/path/pathEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5848f9500b9883_99884896',
  'file_dependency' => 
  array (
    'b68af51a9b85c0dc4c87cc9a4187e38c56fe5d77' => 
    array (
      0 => '/var/www/html/web/view/path/pathEdit.html',
      1 => 1476548762,
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
function content_5848f9500b9883_99884896 ($_smarty_tpl) {
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
                             <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/pathController.php" onsubmit="return pathValidation();">
                                <div id="test"class="box-body">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="svg" class="col-sm-3 control-label">SVG圖上ID</label>
                                            <div class="col-sm-9">
                                                <input id="svg_id" name="svg_id" type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['pathData']->value['svg_id'];?>
">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">起始區域</label>
                                            <select id="start" name="start" class="selectpicker col-sm-9">
                                                <?php
$_from = $_smarty_tpl->tpl_vars['allZone']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['zone_id'] == $_smarty_tpl->tpl_vars['pathData']->value['start']) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php }?>
                                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">目的區域</label>
                                            <select id="end" name="end" class="selectpicker col-sm-9">
                                                <?php
$_from = $_smarty_tpl->tpl_vars['allZone']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_1_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_1_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['zone_id'] == $_smarty_tpl->tpl_vars['pathData']->value['end']) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php }?>
                                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>
                                            </select>
                                        </div>                              
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/beaconController.php?action=listPath" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updatePath">
                                    <input type="hidden" name="pathID" value="<?php echo $_smarty_tpl->tpl_vars['pathID']->value;?>
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
</body>

</html><?php }
}
