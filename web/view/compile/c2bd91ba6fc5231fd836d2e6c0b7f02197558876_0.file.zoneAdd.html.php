<?php
/* Smarty version 3.1.28, created on 2016-11-27 15:33:00
  from "/var/www/html/web/view/zone/zoneAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_583a8c2c644d19_15571545',
  'file_dependency' => 
  array (
    'c2bd91ba6fc5231fd836d2e6c0b7f02197558876' => 
    array (
      0 => '/var/www/html/web/view/zone/zoneAdd.html',
      1 => 1480231780,
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
function content_583a8c2c644d19_15571545 ($_smarty_tpl) {
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
                <h1></h1>
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
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">新增區域</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/zoneController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="zoneNameDiv" class="form-group">
                                        <label for="zoneName" class="col-sm-2 control-label">區域名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneName" name="zoneName" placeholder="輸入區域名稱">
                                        </div>
                                    </div>
                                    <div id="zoneNameEnDiv" class="form-group">
                                        <label for="zoneNameEn" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneNameEn" name="zoneNameEn" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div id="zoneIntroductionDiv" class="form-group">
                                        <label for="zoneIntroduction" class="col-sm-2 control-label">區域介紹</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneIntroduction" name="zoneIntroduction" placeholder="輸入區域介紹">
                                        </div>
                                    </div>
                                    <div id="zoneIntroductionEnDiv" class="form-group">
                                        <label for="zoneIntroductionEn" class="col-sm-2 control-label">區域介紹(英文)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneIntroductionEn" name="zoneIntroductionEn" placeholder="輸入區域介紹">
                                        </div>
                                    </div>
                                    <div id="zoneHintDiv" class="form-group">
                                        <label for="zoneHint" class="col-sm-2 control-label">區域提示</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="zoneHint" name="zoneHint" placeholder="輸入區域提示">
                                        </div>
                                    </div>
                                    <div id="zoneVoiceDiv" class="form-group">
                                        <label for="zoneVoice" class="col-sm-2 control-label">語音導覽</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zoneVoice" name="zoneVoice" data-input="false" accept="audio/*">
                                            <audio id="zoneVoiceAudio" controls src="" type="audio/*" style="display:none">
                                            </audio>
                                        </div>
                                    </div>
                                    <div id="zoneVoiceEnDiv" class="form-group">
                                        <label for="zoneVoiceEn" class="col-sm-2 control-label">語音導覽(英文)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zoneVoiceEn" name="zoneVoiceEn" data-input="false" accept="audio/*">
                                            <audio id="zoneVoiceEnAudio" controls src="" type="audio/*" style="display:none">
                                            </audio>
                                        </div>
                                    </div>
                                    <div id="zonePhotoDiv" class="form-group">
                                        <label for="zonePhoto" class="col-sm-2 control-label">區域圖片(平板)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zonePhoto" name="zonePhoto" data-input="false" accept="image/*">
                                            <img id="zonePhotoImg" class="img-thumbnail" style="display:none" alt="區域圖片(平板)"/>
                                        </div>
                                    </div>
                                    <div id="zonePhotoAppDiv" class="form-group">
                                        <label for="zonePhotoApp" class="col-sm-2 control-label">區域圖片(App)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="zonePhotoApp" name="zonePhotoApp" data-input="false" accept="image/*">
                                            <img id="zonePhotoAppImg" class="img-thumbnail" style="display:none" alt="區域圖片(App)"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/fieldController.php?action=viewFieldDetail&fieldId=<?php echo $_smarty_tpl->tpl_vars['fieldId']->value;?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addZone">
                                    <input type="hidden" name="fieldId" value="<?php echo $_smarty_tpl->tpl_vars['fieldId']->value;?>
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
 src="../javascript/zoneAdd.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
