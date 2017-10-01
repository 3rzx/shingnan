<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:13:53
  from "C:\xampp\htdocs\backend\web\view\user\userEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d139e1892d97_38753236',
  'file_dependency' => 
  array (
    'b87017c5ea031aba8a7d22a93a8beb4cb8539f36' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\user\\userEdit.html',
      1 => 1473134955,
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
function content_57d139e1892d97_38753236 ($_smarty_tpl) {
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
                                <h3 class="box-title">編輯使用者</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/userController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div id="emailDiv" class="form-group<?php if ($_smarty_tpl->tpl_vars['error']->value == 'E-mail已有人使用') {?> has-error<?php }?>">
                                        <label for="email" class="col-sm-2 control-label">E-Mail</label>
                                        <div class="col-sm-10">
                                            <input id="email" name="email" type="email" class="form-control" name="email" placeholder="輸入 E-Mail" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['email'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="competence" class="col-sm-2 control-label">權限</label>
                                        <select name="competence" class="selectpicker col-sm-10">

                                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['userData']->value['competence'] == 0) {?>select: selected<?php }?>>管理員</option>
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['userData']->value['competence'] == 1) {?>select: selected<?php }?>>專案人員</option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['userData']->value['competence'] == 2) {?>select: selected<?php }?>>櫃台人員</option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['userData']->value['competence'] == 3) {?>select: selected<?php }?>>訪客</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="changePass" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-10">
                                            <button id="changePass" name="changePass" type="button" class="btn btn-info">更改密碼</button>
                                        </div>
                                    </div>
                                    <div id="passwordDiv" class="form-group collapse">
                                        <label for="password" class="col-sm-2 control-label">密碼</label>
                                        <div class="col-sm-10">
                                            <input id="password" name="password" type="password" class="form-control" name="password" minLength="6" placeholder="輸入密碼">
                                        </div>
                                    </div>
                                    <div id="repeatPasswordDiv" class="form-group collapse">
                                        <label for="repeatPssword" class="col-sm-2 control-label">重複輸入密碼</label>
                                        <div class="col-sm-10">
                                            <input id="repeatPassword" type="password" class="form-control" name="repeatPassword" minLength="6" placeholder="重複輸入密碼">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/userController.php?action=viewUserList" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateUser">
                                    <input type="hidden" name="userId" value="<?php echo $_smarty_tpl->tpl_vars['userData']->value['user_id'];?>
">
                                    <button type="submit" class="btn btn-primary">更新</button>
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
 src="../javascript/userEdit.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
