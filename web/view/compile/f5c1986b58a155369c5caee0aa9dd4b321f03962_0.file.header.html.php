<?php
/* Smarty version 3.1.28, created on 2017-10-01 17:13:08
  from "C:\xampp\htdocs\shingnan\web\view\common\header.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59d10604c27259_53316698',
  'file_dependency' => 
  array (
    'f5c1986b58a155369c5caee0aa9dd4b321f03962' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\common\\header.html',
      1 => 1506869174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59d10604c27259_53316698 ($_smarty_tpl) {
?>
<header class="main-header">
    <!-- Logo -->
    <div class="logo">
        <img src="../image/living3_icon.png" style="width: 20%;">
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
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../image/living3_icon.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['user']['email'];?>
</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="../controller/userController.php?action=logout" class="btn btn-default btn-flat">登出</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php }?>
            </ul>
        </div>
    </nav>
</header>
<?php }
}
