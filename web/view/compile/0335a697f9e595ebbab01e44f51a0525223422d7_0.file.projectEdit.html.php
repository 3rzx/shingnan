<?php
/* Smarty version 3.1.28, created on 2017-08-22 21:59:22
  from "/var/www/html/web/view/project/projectEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599c38ba0521e6_43373482',
  'file_dependency' => 
  array (
    '0335a697f9e595ebbab01e44f51a0525223422d7' => 
    array (
      0 => '/var/www/html/web/view/project/projectEdit.html',
      1 => 1473736725,
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
function content_599c38ba0521e6_43373482 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">編輯專案</h3>
                            </div>
                            <form class="form-horizontal" method="post" action="../controller/projectController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="projectNameDiv" class="form-group">
                                        <label for="projectName" class="col-sm-2 control-label">專案名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="projectName" name="projectName" placeholder="輸入專案名稱" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div id="projectIntroductionDiv" class="form-group">
                                        <label for="projectIntroduction" class="col-sm-2 control-label">專案介紹</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="projectIntroduction" name="projectIntroduction" placeholder="輸入專案介紹" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['introduction'];?>
">
                                        </div>
                                    </div>
                                    <div id="projectVersionDiv" class="form-group">
                                        <label for="projectVersion" class="col-sm-2 control-label">版本編號</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="projectVersion" name="projectVersion" placeholder="版本編號(ex: 1.0)" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['version'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="projectActive" class="col-sm-2 control-label">專案狀態</label>
                                        <div class="col-sm-10">
                                            <?php if ($_smarty_tpl->tpl_vars['project']->value['active'] == 1) {?>
                                            <input type="checkbox" id="isActive" name="projectActive" checked>
                                            <span id="activeStat" class="text-success"> (專案已開啟)</span>
                                            <?php } else { ?>
                                            <input type="checkbox" id="isActive" name="projectActive">
                                            <span id="activeStat" class="text-danger"> (專案已關閉)</span>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/projectController.php?action=viewProjectList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateProject">
                                    <input type="hidden" name="projectId" value="<?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
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
 src="../javascript/projectEdit.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
