<?php
/* Smarty version 3.1.28, created on 2017-10-02 12:11:30
  from "C:\xampp\htdocs\shingnan\web\view\main.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59d210d270b919_76039931',
  'file_dependency' => 
  array (
    'ab11cc735f6fdcffb7b6b513561e98e19bb92554' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\main.html',
      1 => 1506938459,
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
function content_59d210d270b919_76039931 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body class="hold-transition skin-yellow sidebar-mini">
  <div class="wrapper">
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>請點選左邊選單進行功能操作</h1>
      </section>
      <!-- Main content -->
      <section class="content">
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  </div>
  <!-- ./wrapper -->
</body>

</html><?php }
}
