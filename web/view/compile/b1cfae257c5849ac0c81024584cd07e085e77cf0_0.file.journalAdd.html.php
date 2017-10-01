<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:12:37
  from "C:\xampp\htdocs\tabc_backend_new\web\view\journal\journalAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d18df5516238_87245378',
  'file_dependency' => 
  array (
    'b1cfae257c5849ac0c81024584cd07e085e77cf0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\journal\\journalAdd.html',
      1 => 1473344976,
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
function content_57d18df5516238_87245378 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
<?php echo '<script'; ?>
 type="text/javascript">
    function changeZoneCandidate(){
        var str = '';           //用來放要加入的<td>
        var candidateTotal = 0;
        
        //統計有幾個在同場域內 並記下zone_id
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
            if( <?php echo $_smarty_tpl->tpl_vars['item']->value['field_id'];?>
 == $("#field").val() ){
                candidateTotal++;
            }
        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>

        for(i=0;i<candidateTotal;i++){
            str += '<tr><td>' + (i+1) + '</td>';
            str += '<td>';
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
            if( <?php echo $_smarty_tpl->tpl_vars['item']->value['field_id'];?>
 == $("#field").val() ){
                str += '<input type="radio" name="zoneChoose' + i +'" value=" <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
 &nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<br>';
            }
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>

            str += '</td></tr>';
        }

        document.getElementById('zoneCandidate').innerHTML = str;
        document.getElementById('pathNumber').value = candidateTotal;
    }

    function clean(){
        document.getElementById('zoneCandidate').innerHTML = "";
        $('#field').val(""); 
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
                    <div class="col-md-6">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">路徑編號: <?php echo $_smarty_tpl->tpl_vars['maxPath']->value['max']+1;?>
</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/journalController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label">場域:</label>
                                        <select id="field" name="field" onchange="changeZoneCandidate();" class="selectpicker col-sm-10">
                                            <option value=""></option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['allField']->value;
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
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['field_map_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['field_map_id'];?>
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
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <table id="zoneChooseTable" class="table table-striped"  width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="col-sm-3">順序</th>
                                                        <th>區域</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="zoneCandidate">
                                                </tbody>
                                            </table>   
                                        </div>                                
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a onclick="clean()" class="btn btn-warning">取消</a>
                                    <input id="pathNumber" type="hidden" name="pathNumber" value="0">
                                    <input type="hidden" name="pathId" value="<?php echo $_smarty_tpl->tpl_vars['maxPath']->value['max']+1;?>
">
                                    <input type="hidden" name="action" value="addjournal">
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
