<?php
/* Smarty version 3.1.28, created on 2016-09-12 23:24:59
  from "C:\xampp\htdocs\backend\web\view\field\fieldAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d6c8cbef5705_58845051',
  'file_dependency' => 
  array (
    '82f04c7bc24f5081d16eb0f0241503ef23ccf9b6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\field\\fieldAdd.html',
      1 => 1473679808,
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
function content_57d6c8cbef5705_58845051 ($_smarty_tpl) {
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
                                <h3 class="box-title">新增場域</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/fieldController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="fieldNameDiv" class="form-group">
                                        <label for="fieldName" class="col-sm-2 control-label">場域名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldName" name="fieldName" placeholder="輸入場域名稱">
                                        </div>
                                    </div>
                                    <div id="fieldNameEnDiv" class="form-group">
                                        <label for="fieldNameEn" class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldNameEn" name="fieldNameEn" placeholder="輸入英文名稱">
                                        </div>
                                    </div>
                                    <div id="fieldIntroductionDiv" class="form-group">
                                        <label for="fieldIntroduction" class="col-sm-2 control-label">場域介紹</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fieldIntroduction" name="fieldIntroduction" placeholder="輸入場域介紹">
                                        </div>
                                    </div>
                                    <div id="fieldPhotoDiv" class="form-group">
                                        <label for="fieldPhoto" class="col-sm-2 control-label">場域圖片(平板)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldPhoto" name="fieldPhoto" data-input="false">
                                            <img id="fieldPhotoImg" class="img-thumbnail" style="display:none" alt="場域圖片(平板)"/>
                                        </div>
                                    </div>
                                    <div id="fieldPhotoAppDiv" class="form-group">
                                        <label for="fieldPhotoApp" class="col-sm-2 control-label">場域圖片(App)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldPhotoApp" name="fieldPhotoApp" data-input="false">
                                            <img id="fieldPhotoAppImg" class="img-thumbnail" style="display:none" alt="場域圖片(App)"/>
                                        </div>
                                    </div>
                                    <div id="fieldMapDiv" class="form-group">
                                        <label for="fieldMap" class="col-sm-2 control-label">場域地圖</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="fieldMap" name="fieldMap" data-input="false">
                                            <img id="fieldMapImg" class="img-thumbnail" style="display:none" alt="場域地圖"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/projectController.php?action=viewProjectDetail&projectId=<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addField">
                                    <input type="hidden" name="projectId" value="<?php echo $_smarty_tpl->tpl_vars['projectId']->value;?>
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
 src="../javascript/fieldAdd.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
