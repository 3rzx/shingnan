<?php
/* Smarty version 3.1.28, created on 2016-11-11 12:28:01
  from "/var/www/html/web/view/mode/modeAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_582548d18a42a5_43077521',
  'file_dependency' => 
  array (
    'e9403ae54e6213076966696cb80ba30d985faf2a' => 
    array (
      0 => '/var/www/html/web/view/mode/modeAdd.html',
      1 => 1477981948,
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
function content_582548d18a42a5_43077521 ($_smarty_tpl) {
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
 src="../javascript/modeAdd.js"><?php echo '</script'; ?>
>
</heed>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>新增展項</h1>
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
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/modeController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="modeNameDiv" class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeName" name="modeName" placeholder="輸入裝置名稱">
                                        </div>
                                    </div>
                                    <div id="modeNameEnDiv" class="form-group">
                                        <label class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeNameEn" name="modeNameEn" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div id="modeIntroductionDiv" class="form-group">
                                        <label class="col-sm-2 control-label">簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeIntroduction" name="modeIntroduction" placeholder="輸入裝置簡介">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">語音導覽</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeGuideVoice" name="modeGuideVoice" data-input="false" accept="audio/*">
                                            <audio controls id="modeGuideVoiceAudio" style="display:none"></audio>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文語音導覽</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeGuideVoiceEn" name="modeGuideVoiceEn" data-input="false" accept="audio/*">
                                            <audio controls id="modeGuideVoiceEnAudio" style="display:none"></audio>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">影片</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeVideo" name="modeVideo" placeholder="輸入影片網址">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(背景)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBG" name="modeBG" data-input="false" accept="image/*">
                                            <img id="modeBGImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(背景)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBGVertical" name="modeBGVertical" data-input="false" accept="image/*">
                                            <img id="modeBGVerticalImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(強調高亮)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeFG" name="modeFG" data-input="false" accept="image/*">
                                            <img id="modeFGImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(強調高亮)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeFGVertical" name="modeFGVertical" data-input="false" accept="image/*">
                                            <img id="modeFGVerticalImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(模糊)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBL" name="modeBL" data-input="false" accept="image/*">
                                            <img id="modeBLImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(模糊)</label>
                                        <div class="col-sm-10">
                                           <input type="file" id="modeBLVertical" name="modeBLVertical" data-input="false" accept="image/*">
                                            <img id="modeBLVerticalImg" class="img-thumbnail" style="display:none">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">所屬區域</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value;?>
" disabled="disabled">
                                        </div>
                                    </div>                     
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/zoneController.php?action=viewZoneDetail&zoneId=<?php echo $_smarty_tpl->tpl_vars['zone']->value;?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addMode">
                                    <input type="hidden" name="zoneID" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value;?>
">
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
