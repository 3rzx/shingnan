<?php
/* Smarty version 3.1.28, created on 2017-09-21 14:50:52
  from "/var/www/html/web/view/path/pathAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59c3614cb32633_87331971',
  'file_dependency' => 
  array (
    'fafb84092bcf921e02f32e79004359986debaf4e' => 
    array (
      0 => '/var/www/html/web/view/path/pathAdd.html',
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
function content_59c3614cb32633_87331971 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
<?php echo '<script'; ?>
 type="text/javascript">

    function pathValidation(){          //檢查SVG_ID是否重複
        <?php
$_from = $_smarty_tpl->tpl_vars['allSvgID']->value;
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
            if( $('#svg_id').val() == <?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
){
                BootstrapDialog.alert("該SVG_ID已使用，修改請至路盡管理修改");
                return false;
            }
        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
        
        if( $('#start').val() == ""){
            BootstrapDialog.alert("未選擇起始區域");
            return false;
        }
        
        if( $('#end').val() == ""){
            BootstrapDialog.alert("未選擇目的區域");
            return false;
        }
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
                <h1>新增路徑</h1>
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
                        <?php if ($_smarty_tpl->tpl_vars['msg']->value != '') {?>
                        <div class="alert alert-success alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-primary">
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/pathController.php" onsubmit="return pathValidation();">
                                <div id="test"class="box-body">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="svg" class="col-sm-3 control-label">SVG圖上ID</label>
                                            <div class="col-sm-9">
                                                <input id="svg_id" name="svg_id" type="text" class="form-control" placeholder="輸入SVG圖上ID">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">起始區域</label>
                                            <select id="start" name="start" class="selectpicker col-sm-9">
                                                <option value=""></option>
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
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
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
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">目的區域</label>
                                            <select id="end" name="end" class="selectpicker col-sm-9">
                                                <option value=""></option>
                                                <?php
$_from = $_smarty_tpl->tpl_vars['allZone']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_2_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_2_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
?>
                                            </select>
                                        </div>                              
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/pathController.php?action=addPathForm" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addPath">
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
