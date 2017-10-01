<?php
/* Smarty version 3.1.28, created on 2017-02-23 11:35:12
  from "/var/www/html/web/view/field/fieldEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58ae5870d69743_93287355',
  'file_dependency' => 
  array (
    'feda77472ddf27132ba531f59bfa212136a9835f' => 
    array (
      0 => '/var/www/html/web/view/field/fieldEdit.html',
      1 => 1478666235,
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
function content_58ae5870d69743_93287355 ($_smarty_tpl) {
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
                                <h3 class="box-title">編輯場域</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/fieldController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="fieldNameDiv" class="form-group">
                                        <label for="fieldName" class="col-sm-2 control-label">場域名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldName" name="fieldName" placeholder="輸入場域名稱" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div id="fieldNameEnDiv" class="form-group">
                                        <label for="fieldNameEn" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldNameEn" name="fieldNameEn" placeholder="輸入英文名稱" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['name_en'];?>
">
                                        </div>
                                    </div>
                                    <div id="fieldIntroductionDiv" class="form-group">
                                        <label for="fieldIntroduction" class="col-sm-2 control-label">場域介紹</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldIntroduction" name="fieldIntroduction" placeholder="輸入場域介紹" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['introduction'];?>
">
                                        </div>
                                    </div>
                                    <div id="fieldPhotoDiv" class="form-group">
                                        <label for="fieldPhoto" class="col-sm-2 control-label">場域圖片(平板)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldPhoto" name="fieldPhoto" data-input="false" accept="image/*">
                                            <img id="fieldPhotoImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['field']->value['photo'];?>
"/>
                                        </div>
                                    </div>
                                    <div id="fieldPhotoAppDiv" class="form-group">
                                        <label for="fieldPhotoApp" class="col-sm-2 control-label">場域圖片(App)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldPhotoApp" name="fieldPhotoApp" data-input="false" accept="image/*">
                                            <img id="fieldPhotoAppImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['field']->value['photo_vertical'];?>
"/>
                                        </div>
                                    </div>
                                    <div id="fieldMapDiv" class="form-group">
                                        <label for="fieldMap" class="col-sm-2 control-label">場域地圖</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldMap" name="fieldMap" data-input="false" accept="image/*">
                                            <img id="fieldMapImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_svg'];?>
"/>
                                        </div>
                                    </div>
                                    <div id="fieldMapEnDiv" class="form-group">
                                        <label for="fieldMapEn" class="col-sm-2 control-label">場域地圖(英文)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldMapEn" name="fieldMapEn" data-input="false" accept="image/*">
                                            <img id="fieldMapEnImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_svg_en'];?>
"/>
                                        </div>
                                    </div>
                                    <div id="fieldMapBgDiv" class="form-group">
                                        <label for="fieldMapBg" class="col-sm-2 control-label">場域背景</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldMapBg" name="fieldMapBg" data-input="false" accept="image/*">
                                            <img id="fieldMapBgImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_bg'];?>
"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/projectController.php?action=viewProjectDetail&projectId=<?php echo $_smarty_tpl->tpl_vars['field']->value['project_id'];?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateField">
                                    <input type="hidden" name="projectId" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['project_id'];?>
">
                                    <input type="hidden" name="fieldId" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
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
 src="../javascript/fieldEdit.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
