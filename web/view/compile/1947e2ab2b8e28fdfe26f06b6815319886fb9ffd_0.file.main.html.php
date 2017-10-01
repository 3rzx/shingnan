<?php
/* Smarty version 3.1.28, created on 2017-09-21 14:50:37
  from "/var/www/html/web/view/main.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59c3613d5b2ff3_02301086',
  'file_dependency' => 
  array (
    '1947e2ab2b8e28fdfe26f06b6815319886fb9ffd' => 
    array (
      0 => '/var/www/html/web/view/main.html',
      1 => 1473736721,
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
function content_59c3613d5b2ff3_02301086 ($_smarty_tpl) {
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
