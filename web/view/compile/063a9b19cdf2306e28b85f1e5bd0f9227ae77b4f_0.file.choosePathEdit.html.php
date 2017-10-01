<?php
/* Smarty version 3.1.28, created on 2017-02-22 13:39:32
  from "/var/www/html/web/view/path/choosePathEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58ad2414c73075_58168217',
  'file_dependency' => 
  array (
    '063a9b19cdf2306e28b85f1e5bd0f9227ae77b4f' => 
    array (
      0 => '/var/www/html/web/view/path/choosePathEdit.html',
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
function content_58ad2414c73075_58168217 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
>
     function pathValidation(){          //檢查有無重複路徑
        return true;
    }

    <?php echo '</script'; ?>
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
                <h1>走法修改</h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
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

                        <div class="box box-success">   
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/pathController.php" onsubmit="return pathValidation();">
                                <div class="box-body">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="row">
                                            <label class="col-sm-3 control-label">順序</label>
                                            <label class="col-sm-9" style="padding-top:7px;text-align:left">選擇路徑(SVG ID)</label> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
$_from = $_smarty_tpl->tpl_vars['pathData']->value;
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
                                            <label for="svg" class="col-sm-3 control-label"><?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
</label>
                                            <div id="pathSelect<?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
" class="col-sm-9">
                                                <select id="path<?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
" name="path<?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
" class="selectpicker">
                                                    <?php
$_from = $_smarty_tpl->tpl_vars['allPath']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item2_1_saved_item = isset($_smarty_tpl->tpl_vars['item2']) ? $_smarty_tpl->tpl_vars['item2'] : false;
$_smarty_tpl->tpl_vars['item2'] = new Smarty_Variable();
$__foreach_item2_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item2_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item2']->value) {
$__foreach_item2_1_saved_local_item = $_smarty_tpl->tpl_vars['item2'];
?>
                                                        <?php if ($_smarty_tpl->tpl_vars['item']->value['svg_id'] == $_smarty_tpl->tpl_vars['item2']->value['svg_id']) {?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item2']->value['svg_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item2']->value['svg_id'];?>
&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item2']->value['start'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['Sn'];?>
 &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item2']->value['end'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['En'];?>
</option>
                                                        <?php } else { ?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['item2']->value['svg_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item2']->value['svg_id'];?>
&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item2']->value['start'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['Sn'];?>
 &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item2']->value['end'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['En'];?>
</option>
                                                        <?php }?>
                                                    <?php
$_smarty_tpl->tpl_vars['item2'] = $__foreach_item2_1_saved_local_item;
}
}
if ($__foreach_item2_1_saved_item) {
$_smarty_tpl->tpl_vars['item2'] = $__foreach_item2_1_saved_item;
}
?>    
                                                </select>
                                            </div>
                                            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
                                        </div>       
                                    </div>
                                </div>
                                <!--box-body-->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/pathController.php?action=listChoosePath" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="choosePathID" value="<?php echo $_smarty_tpl->tpl_vars['choosePathID']->value;?>
">
                                    <input type="hidden" name="pathCount" value="<?php echo $_smarty_tpl->tpl_vars['pathCount']->value;?>
">
                                    <input type="hidden" name="action" value="updateChoosePath">
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
</body>

</html>
<?php }
}
