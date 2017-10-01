<?php
/* Smarty version 3.1.28, created on 2017-09-21 14:51:00
  from "/var/www/html/web/view/path/choosePathAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59c361544ba544_15614489',
  'file_dependency' => 
  array (
    '7380ae2ac0cb664f55354737621ccb920bc28ed4' => 
    array (
      0 => '/var/www/html/web/view/path/choosePathAdd.html',
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
function content_59c361544ba544_15614489 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
<?php echo '<script'; ?>
 type="text/javascript">
    var i=1;

    function pathValidation(){          //檢查有無重複路徑
        return true;
    }

    function deletePath(item){
        i--;
        var target = '#path' + item + 'Form';
        $(target).remove();
        if(i>1){
            var str=''; 
            str +=      '<div id="deleteDiv' + i + '"class="col-sm-1">'
            str +=          '<a class="btn btn-sm btn-danger" onclick="deletePath('+ i +')"><i class="glyphicon glyphicon-remove"></i></a>'
            $('#pathSelect' + i ).after(str);
        }
    }

    function addPath(){
        i++;
        var str = '';
        str += '<div id="path' + i + 'Form" class="form-group">'
        str +=      '<label class="col-sm-3 control-label">'+ i +'</label>'
        str +=      '<div id="pathSelect' + i + '" name="pathSelect' + i + '" class="col-sm-6">'
        str +=      '</div>'
        str +=      '<div id="deleteDiv' + i + '"class="col-sm-1">'
        str +=          '<a class="btn btn-sm btn-danger" onclick="deletePath('+ i +')"><i class="glyphicon glyphicon-remove"></i></a>'
        str +=      '</div>'
        str +=  '</div>';
        $('#forAddPath').before(str);
        
        var x = document.createElement("SELECT");
        x.setAttribute("id", "path" + i);
        x.setAttribute("name", "path" + i);
        x.setAttribute("class", "selectpicker");
        document.getElementById('pathSelect' + i).appendChild(x);
        $("#path" + i).append($("<option></option>").attr("value", "null").text(""));
        <?php
$_from = $_smarty_tpl->tpl_vars['allPath']->value;
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
            $("#path" + i).append($("<option></option>").attr("value", "<?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
").text("<?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
 | <?php echo $_smarty_tpl->tpl_vars['item']->value['start'];
echo $_smarty_tpl->tpl_vars['item']->value['Sn'];?>
 | <?php echo $_smarty_tpl->tpl_vars['item']->value['end'];
echo $_smarty_tpl->tpl_vars['item']->value['En'];?>
"));
        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
        $("#path" + i).selectpicker('refresh');
        $("#deleteDiv" + (i-1)).remove();
        $("#pathCount").val(i);

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
                <h1>新增走法</h1>
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
                                <div class="box-body">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <div class="row">
                                            <label class="col-sm-3 control-label">順序</label>
                                            <label class="col-sm-7" style="padding-top:7px;text-align:left">選擇路徑(SVG ID)</label> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="svg" class="col-sm-3 control-label">1</label>
                                            <div id="pathSelect1" class="col-sm-6">
                                                <select id="path1" name="path1" class="selectpicker">
                                                    <option value="null"></option>
                                                    <?php
$_from = $_smarty_tpl->tpl_vars['allPath']->value;
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
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
&nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item']->value['start'];?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['Sn'];?>
 &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo $_smarty_tpl->tpl_vars['item']->value['end'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['En'];?>
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
                                            <div class="col-sm-1">
                                                <a class="btn btn-sm btn-primary" onclick="addPath();"><i class="glyphicon glyphicon-plus"></i></a>
                                            </div>
                                        </div>
                                        <div id="forAddPath"></div>              
                                    </div>                             
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/pathController.php?action=addChoosePathForm" class="btn btn-warning">取消</a>
                                    <input id="pathCount" type="hidden" name="pathCount" value="0">
                                    <input type="hidden" name="action" value="addChoosePath">
                                    <button type="submit" class="btn btn-primary">確定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="t"></div>
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
