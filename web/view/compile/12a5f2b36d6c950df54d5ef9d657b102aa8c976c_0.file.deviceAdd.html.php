<?php
/* Smarty version 3.1.28, created on 2016-11-25 22:12:22
  from "/var/www/html/web/view/device/deviceAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_583846c633ea10_50809737',
  'file_dependency' => 
  array (
    '12a5f2b36d6c950df54d5ef9d657b102aa8c976c' => 
    array (
      0 => '/var/www/html/web/view/device/deviceAdd.html',
      1 => 1478385854,
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
function content_583846c633ea10_50809737 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"> <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../javascript/deviceAdd.js"><?php echo '</script'; ?>
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
                    <div class="col-md-6">
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
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/deviceController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="deviceNameDiv" class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceName" name="deviceName" placeholder="輸入裝置名稱">
                                        </div>
                                    </div>
                                    <div id="deviceNameEnDiv" class="form-group">
                                        <label class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceNameEn" name="deviceNameEn" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div id="deviceIntroductionDiv" class="form-group">
                                        <label class="col-sm-2 control-label">簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceIntroduction" name="deviceIntroduction" placeholder="輸入裝置簡介">
                                        </div>
                                    </div>
                                    <div id="deviceHintDiv" class="form-group">
                                        <label class="col-sm-2 control-label">裝置提示</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="deviceHint" name="deviceHint" placeholder="輸入裝置提示">
                                        </div>
                                    </div>
                                    <div id="deviceGuideVoiceDiv" class="form-group">
                                        <label class="col-sm-2 control-label">導覽語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="deviceGuideVoice" name="deviceGuideVoice" data-input="false" accept="audio/*">
                                            <audio controls id="deviceGuideVoiceAudio" style="display:none">
                                            </audio>
                                        </div>
                                    </div>
                                    <div id="deviceGuideVoiceEnDiv" class="form-group">
                                        <label class="col-sm-2 control-label">英文導覽語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="deviceGuideVoiceEn" name="deviceGuideVoiceEn" data-input="false" accept="audio/*">
                                            <audio controls id="deviceGuideVoiceEnAudio" style="display:none">
                                            </audio>
                                        </div>
                                    </div>
                                    <div id="devicePhotoDiv" class="form-group">
                                        <label class="col-sm-2 control-label">裝置圖片</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="devicePhoto" name="devicePhoto" data-input="false" accept="image/*">
                                            <img id="devicePhotoImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div id="devicePhotoVerticalDiv" class="form-group">
                                        <label class="col-sm-2 control-label">直式裝置圖片</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="devicePhotoVertical" name="devicePhotoVertical" data-input="false" accept="image/*">
                                            <img id="devicePhotoVerticalImg" class="img-thumbnail" style="display:none" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">所屬展項</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"  value="<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" disabled="disabled">
                                        </div>
                                    </div>
                                    <div id="deviceCompanyDiv" class="form-group">
                                        <label class="col-sm-2 control-label">提供公司</label>
                                        <div class="col-sm-6">
                                            <select id="deviceCompany" name="deviceCompany" class="selectpicker col-sm-10">
                                                <option value=""></option>
                                                <?php
$_from = $_smarty_tpl->tpl_vars['allCompany']->value;
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
"> <?php echo $_smarty_tpl->tpl_vars['item']->value['company_id'];?>
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
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/modeController.php?action=detailMode&modeID=<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="deviceMode" value="<?php echo $_smarty_tpl->tpl_vars['mode']->value;?>
">
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
