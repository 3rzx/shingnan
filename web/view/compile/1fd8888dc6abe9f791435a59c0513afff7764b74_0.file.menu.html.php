<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:17:42
  from "C:\xampp\htdocs\tabc_backend_new\web\view\common\menu.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d18f2697d714_08271282',
  'file_dependency' => 
  array (
    '1fd8888dc6abe9f791435a59c0513afff7764b74' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\common\\menu.html',
      1 => 1473348072,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57d18f2697d714_08271282 ($_smarty_tpl) {
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <?php if ($_SESSION['isLogin']) {?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header" style="color:#FFFFFF; font-size: 24px;">功 能 列 表</li>
            <?php if ($_SESSION['user']['competence'] == 0) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>使用者管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/userController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>使用者新增</a></li>
                    <li><a href="../controller/userController.php?action=viewUserList"><i class="fa fa-circle-o"></i>使用者列表</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 3) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>貴賓證管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($_SESSION['user']['competence'] < 2) {?>
                    <li><a href=""><i class="fa fa-circle-o"></i>新增貴賓證</a></li>
                    <?php }?>
                    <li><a href=""><i class="fa fa-circle-o"></i>設定貴賓證</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>Beacon管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/userController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>新增Beacon</a></li>
                    <li><a href="../controller/userController.php?action=viewUserList"><i class="fa fa-circle-o"></i>編輯Beacon</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>路徑管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/journalController.php?action=addForm"><i class="fa fa-circle-o"></i>新增路徑</a></li>
                    <li><a href="../controller/journalController.php?action=list"><i class="fa fa-circle-o"></i>編輯路徑</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>圖資專案管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i>新增專案</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i>專案管理</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 3) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>行動導覽裝置管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($_SESSION['user']['competence'] < 2) {?>
                    <li><a href=""><i class="fa fa-circle-o"></i>裝置管理租借</a></li>
                    <?php }?>
                    <li><a href=""><i class="fa fa-circle-o"></i>新增租借</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i>裝置歸還</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>文青樣板管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i>新增樣板</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i>樣板管理</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 4) {?>
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i><span>統計與報表功能</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/statisticController.php?action=viewSurveyResult"><i class="fa fa-circle-o"></i>問卷調查統計</a></li>
                    <li><a href="../controller/statisticController.php?action=viewLikeCount"><i class="fa fa-circle-o"></i>按讚統計</a></li>
                </ul>
            </li>
            <?php }?>
        </ul>
        <?php }?>
    </section>
</aside>
<?php }
}
