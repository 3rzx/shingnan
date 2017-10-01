<?php
/* Smarty version 3.1.28, created on 2016-09-13 10:41:45
  from "C:\xampp\htdocs\backend\web\view\journal\journalEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d76769d561c7_18782214',
  'file_dependency' => 
  array (
    '8fdf7252dddffbedfcc8762109adc61104c0160e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\journal\\journalEdit.html',
      1 => 1473600802,
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
function content_57d76769d561c7_18782214 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
>
    /*function pathValidation(){      //檢查有無重複路徑
        var pathCount = <?php echo $_smarty_tpl->tpl_vars['pathCount']->value;?>
;
        var zoneIsSet = new Array(pathCount);
        for(i=0;i<pathCount;i++){
            if(zoneIsSet[ $('zoneChoose'+i).val() ] == 1)
                return false;
            else
                zoneIsSet[ $('zoneChoose'+i).val() ] = 1;
        }
        return true;
    }*/

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
                <h1>路徑修改</h1>
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

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">路徑編號: &nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['pathID']->value;?>
</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/journalController.php" onsubmit="return pathValidation();">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <table id="zoneChooseTable" class="table table-striped"  width="100%">
                                                <thead style="background-color: #3c8dbc;color: #fff;">
                                                    <tr>
                                                        <th class="col-sm-3">順序</th>
                                                        <th>區域</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="zoneCandidate">                                              
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
?><!--對於每個order列出所有候選-->
                                                    <tr><td><?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
</td><td>
                                                       <?php
$_from = $_smarty_tpl->tpl_vars['pathData2']->value;
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
                                                            <?php if ($_smarty_tpl->tpl_vars['item2']->value['zone_id'] == $_smarty_tpl->tpl_vars['item']->value['zone_id']) {?>
                                                                <input type="radio" name="zoneChoose<?php echo $_smarty_tpl->tpl_vars['item']->value['order']-1;?>
" value=" <?php echo $_smarty_tpl->tpl_vars['item2']->value['zone_id'];?>
" checked><?php echo $_smarty_tpl->tpl_vars['item2']->value['zone_id'];?>
 &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['name'];?>
<br>
                                                            <?php } else { ?>
                                                                <input type="radio" name="zoneChoose<?php echo $_smarty_tpl->tpl_vars['item']->value['order']-1;?>
" value=" <?php echo $_smarty_tpl->tpl_vars['item2']->value['zone_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item2']->value['zone_id'];?>
 &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['name'];?>
<br>
                                                            <?php }?>
                                                        <?php
$_smarty_tpl->tpl_vars['item2'] = $__foreach_item2_1_saved_local_item;
}
}
if ($__foreach_item2_1_saved_item) {
$_smarty_tpl->tpl_vars['item2'] = $__foreach_item2_1_saved_item;
}
?>
                                                    </td></tr>
                                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
                                                </tbody>
                                            </table>   
                                        </div>                                
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/journalController.php?action=listJournal" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="pathId" value="<?php echo $_smarty_tpl->tpl_vars['pathID']->value;?>
">
                                    <input type="hidden" name="action" value="updateJournal">
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
