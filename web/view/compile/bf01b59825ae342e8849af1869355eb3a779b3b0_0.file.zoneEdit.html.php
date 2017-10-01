<?php
/* Smarty version 3.1.28, created on 2017-02-22 18:59:22
  from "/var/www/html/web/view/zone/zoneEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58ad6f0b003414_17233234',
  'file_dependency' => 
  array (
    'bf01b59825ae342e8849af1869355eb3a779b3b0' => 
    array (
      0 => '/var/www/html/web/view/zone/zoneEdit.html',
      1 => 1480231926,
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
function content_58ad6f0b003414_17233234 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- Bootstrap3 input file 1.2.1 -->
    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"> <?php echo '</script'; ?>
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
                <h1>專案編輯</h1>
            </section>
            <!-- Main content -->
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
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯區域</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/zoneController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="zoneNameDiv" class="form-group">
                                        <label for="zoneName" class="col-sm-2 control-label">區域名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneName" name="zoneName" placeholder="輸入區域名稱" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div id="zoneNameEnDiv" class="form-group">
                                        <label for="zoneNameEn" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneNameEn" name="zoneNameEn" placeholder="輸入英文名稱" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['name_en'];?>
">
                                        </div>
                                    </div>
                                    <div id="zoneIntroductionDiv" class="form-group">
                                        <label for="zoneIntroduction" class="col-sm-2 control-label">區域介紹</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneIntroduction" name="zoneIntroduction" placeholder="輸入區域介紹" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['introduction'];?>
">
                                        </div>
                                    </div>
                                    <div id="zoneIntroductionEnDiv" class="form-group">
                                        <label for="zoneIntroductionEn" class="col-sm-2 control-label">區域介紹(英文)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneIntroductionEn" name="zoneIntroductionEn" placeholder="輸入區域介紹" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['introduction_en'];?>
">
                                        </div>
                                    </div>
                                    <div id="zoneHintDiv" class="form-group">
                                        <label for="zoneHint" class="col-sm-2 control-label">區域提示</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneHint" name="zoneHint" placeholder="輸入區域提示" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['hint'];?>
">
                                        </div>
                                    </div>
                                    <div id="zoneVoiceDiv" class="form-group">
                                        <label for="zoneVoice" class="col-sm-2 control-label">導覽語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zoneVoice" name="zoneVoice" data-input="false" accept="audio/*">
                                            <?php if ($_smarty_tpl->tpl_vars['zone']->value['guide_voice'] == null) {?>
                                            尚無語音檔
                                            <?php } else { ?>
                                            <audio id="zoneVoiceAudio" controls src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['guide_voice'];?>
" type="audio/*">
                                            </audio>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div id="zoneVoiceEnDiv" class="form-group">
                                        <label for="zoneVoiceEn" class="col-sm-2 control-label">導覽語音(英文)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zoneVoiceEn" name="zoneVoiceEn" data-input="false" accept="audio/*">
                                            <?php if ($_smarty_tpl->tpl_vars['zone']->value['guide_voice_en'] == null) {?>
                                            尚無語音檔
                                            <?php } else { ?>
                                            <audio id="zoneVoiceEnAudio" controls src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['guide_voice_en'];?>
" type="audio/*">
                                            </audio>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div id="zonePhotoDiv" class="form-group">
                                        <label for="zonePhoto" class="col-sm-2 control-label">區域圖片(平板)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zonePhoto" name="zonePhoto" data-input="false" accept="image/*">
                                            <img id="zonePhotoImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['photo'];?>
"/>
                                        </div>
                                    </div>
                                    <div id="zonePhotoAppDiv" class="form-group">
                                        <label for="zonePhotoApp" class="col-sm-2 control-label">區域圖片(App)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zonePhotoApp" name="zonePhotoApp" data-input="false" accept="image/*">
                                            <img id="zonePhotoAppImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['photo_vertical'];?>
"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/fieldController.php?action=viewFieldDetail&fieldId=<?php echo $_smarty_tpl->tpl_vars['zone']->value['field_id'];?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateZone">
                                    <input type="hidden" name="zoneId" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['zone_id'];?>
">
                                    <input type="hidden" name="fieldId" value="<?php echo $_smarty_tpl->tpl_vars['zone']->value['field_id'];?>
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
    <?php echo '<script'; ?>
 src="../javascript/zoneEdit.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
