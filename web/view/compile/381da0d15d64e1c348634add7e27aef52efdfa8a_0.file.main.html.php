<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:12:32
  from "C:\xampp\htdocs\tabc_backend_new\web\view\main.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d18df0515264_71530943',
  'file_dependency' => 
  array (
    '381da0d15d64e1c348634add7e27aef52efdfa8a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\main.html',
      1 => 1472975779,
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
function content_57d18df0515264_71530943 ($_smarty_tpl) {
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
        <h1>歡迎使用導覽管理系統</h1>
      </section>
      <!-- Main content -->
      <section class="content">
        請點選左邊選單進行功能操作。
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
