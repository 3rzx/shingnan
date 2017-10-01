<?php
/* Smarty version 3.1.28, created on 2017-08-22 13:08:27
  from "/var/www/html/web/view/device/deviceEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599bbc4b8a64f4_59534276',
  'file_dependency' => 
  array (
    'a2d133de3d62073c1727bc676e10ffb841cbad6d' => 
    array (
      0 => '/var/www/html/web/view/device/deviceEdit.html',
      1 => 1481903786,
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
function content_599bbc4b8a64f4_59534276 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="../javascript/deviceEdit.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"><?php echo '</script'; ?>
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
                <h1>修改裝置</h1>
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">裝置編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/deviceController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceName" name="deviceName" value="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceNameEn" name="deviceNameEn" value="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['name_en'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceIntroduction" name="deviceIntroduction" value="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['introduction'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">裝置提示</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceHint" name="deviceHint" value="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['hint'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">導覽語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="deviceGuideVoice" name="deviceGuideVoice" data-input="false" accept="audio/*">
                                            <audio controls id="deviceGuideVoiceAudio" src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['guide_voice'];?>
">
                                            </audio>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文導覽語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="deviceGuideVoiceEn" name="deviceGuideVoiceEn" data-input="false" accept="audio/*">
                                            <audio controls id="deviceGuideVoiceEnAudio" src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['guide_voice_en'];?>
">
                                            </audio>    
                                        </div>
                                    </div>
                                    <div id="devicePhotoDiv" class="form-group">
                                        <label class="col-sm-2 control-label">裝置圖片</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="devicePhoto" name="devicePhoto" data-input="false">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['photo'];?>
" id="devicePhotoImg" class="img-thumbnail" alt="尚未設定裝置圖片"/>
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">直式裝置圖片</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="devicePhotoVertical" name="devicePhotoVertical">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['photo_vertical'];?>
" id="devicePhotoVerticalImg" class="img-thumbnail" alt="尚未設定直式裝置圖片">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">隸屬展項</label>
                                        <div class="col-sm-10">
                                            <select id="deviceMode" name="deviceMode" class="selectpicker col-sm-10">
                                            <option value=""></option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['allModeData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item3_0_saved_item = isset($_smarty_tpl->tpl_vars['item3']) ? $_smarty_tpl->tpl_vars['item3'] : false;
$_smarty_tpl->tpl_vars['item3'] = new Smarty_Variable();
$__foreach_item3_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item3_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item3']->value) {
$__foreach_item3_0_saved_local_item = $_smarty_tpl->tpl_vars['item3'];
?>
                                                <?php if ($_smarty_tpl->tpl_vars['item3']->value['mode_id'] == $_smarty_tpl->tpl_vars['deviceData']->value['mode_id']) {?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item3']->value['mode_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item3']->value['mode_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item3']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item3']->value['mode_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item3']->value['mode_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item3']->value['name'];?>
</option>
                                                <?php }?>
                                            <?php
$_smarty_tpl->tpl_vars['item3'] = $__foreach_item3_0_saved_local_item;
}
}
if ($__foreach_item3_0_saved_item) {
$_smarty_tpl->tpl_vars['item3'] = $__foreach_item3_0_saved_item;
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
$_from = $_smarty_tpl->tpl_vars['allCompanyData']->value;
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
                                                <?php if ($_smarty_tpl->tpl_vars['item2']->value['company_id'] == $_smarty_tpl->tpl_vars['deviceData']->value['company_id']) {?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item2']->value['company_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item2']->value['company_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item2']->value['company_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['item2']->value['company_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item2']->value['name'];?>
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
                                    </div>                        
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/deviceController.php?action=detailDevice&deviceID=<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
" class="btn btn-warning" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="deviceID" value="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
">
                                    <input type="hidden" name="action" value="updateDevice">
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
