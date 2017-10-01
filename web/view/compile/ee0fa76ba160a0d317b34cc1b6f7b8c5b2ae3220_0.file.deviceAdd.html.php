<?php
/* Smarty version 3.1.28, created on 2016-09-12 11:40:35
  from "C:\xampp\htdocs\backend\web\view\device\deviceAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d623b35b6c57_37206342',
  'file_dependency' => 
  array (
    'ee0fa76ba160a0d317b34cc1b6f7b8c5b2ae3220' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\device\\deviceAdd.html',
      1 => 1473612282,
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
function content_57d623b35b6c57_37206342 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
<?php echo '<script'; ?>
 type="text/javascript">
    function clean(){
        $('#deviceName').val("");
        $('#deviceNameEn').val("");
        $('#deviceIntroduction').val(""); 
        $('#deviceHint').val("");
        $('#devicePhoto').val("");
        //$('deviceCompany').val("");
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
                <h1>新增裝置</h1>
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
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/deviceController.php" onsubmit="checkfunction">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceName" name="deviceName" placeholder="輸入裝置名稱">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceNameEn" name="deviceNameEn" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceIntroduction" name="deviceIntroduction" placeholder="輸入裝置簡介">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="deviceIntroduction" class="col-sm-2 control-label">提示</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceHint" name="deviceHint" placeholder="輸入裝置提示">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">圖片</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="devicePhoto" name="devicePhoto" data-input="false" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group">
                                            <span class="group-span-filestyle " tabindex="0">
                                                <label for="devicePhoto" class="btn btn-info ">
                                                    <span class="icon-span-filestyle glyphicon glyphicon-camera"></span> 
                                                    <span class="buttonText">上傳圖片</span>
                                                </label>
                                            </span>
                                        </div>
                                            <img id="devicePhotoImg" class="img-thumbnail" style="display:none" alt="裝置圖片">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">所屬區域</label>
                                        <div class="col-sm-10">
                                            <select id="deviceMode" name="deviceMode" class="selectpicker col-sm-10">
                                            <option value=""></option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['allMode']->value;
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
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['company_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
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
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">提供公司</label>
                                        <div class="col-sm-10">
                                            <select id="deviceCompany" name="deviceCompany" class="selectpicker col-sm-10">
                                            <option value=""></option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['allCompany']->value;
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
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['company_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['company_id'];?>
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
                                    </div>                        
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a onclick="clean();" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addDevice">
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
