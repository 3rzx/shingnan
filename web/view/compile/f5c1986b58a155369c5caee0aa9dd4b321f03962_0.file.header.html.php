<?php
/* Smarty version 3.1.28, created on 2018-01-17 09:55:03
  from "C:\xampp\htdocs\shingnan\web\view\common\header.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5a5f0f6751fba7_61288205',
  'file_dependency' => 
  array (
    'f5c1986b58a155369c5caee0aa9dd4b321f03962' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\common\\header.html',
      1 => 1516178958,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a5f0f6751fba7_61288205 ($_smarty_tpl) {
?>
<header class="main-header">
    <!-- Logo -->
    <div class="logo">
        <img src="../image/glasses_icon.png" style="width: 22%;">
    </div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Sidebar toggle button-->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if ($_SESSION['isLogin']) {?>
                <li class="dropdown messages-menu">
                    <a href="../controller/adminController.php?action=main" class="dropdown-toggle">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $_SESSION['user']['account'];?>
</span>
                    </a>
                </li>
                <li class="dropdown messages-menu">
                    <a href="../controller/adminController.php?action=logout" class="dropdown-toggle">
                        <i class="fa fa-sign-out">&nbsp;登出</i>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
    </nav>
</header><?php }
}
