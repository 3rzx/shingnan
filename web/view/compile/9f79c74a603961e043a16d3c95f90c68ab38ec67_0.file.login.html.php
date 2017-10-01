<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:11:21
  from "C:\xampp\htdocs\tabc_backend_new\web\view\login.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d18da9359398_91032198',
  'file_dependency' => 
  array (
    '9f79c74a603961e043a16d3c95f90c68ab38ec67' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\login.html',
      1 => 1473049830,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/resource.html' => 1,
    'file:common/header.html' => 1,
    'file:common/menu.html' => 1,
    'file:common/footer.html' => 1,
  ),
),false)) {
function content_57d18da9359398_91032198 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>登入</h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
            <div class="alert alert-warning alert-dismissable text-center">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
            </div>
            <?php }?>
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">請輸入您的帳號（email）及密碼</h3>
              </div>
              <form role="form" method="post" action="../controller/userController.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">密碼</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                </div>
                <div class="box-footer">
                  <input type="hidden" name="action" value="login">
                  <button type="submit" class="btn btn-primary">確定</button>
                </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  </div>
  <!-- ./wrapper -->
</body>

</html>
<?php }
}
