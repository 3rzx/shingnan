<?php
/* Smarty version 3.1.28, created on 2017-10-01 17:13:08
  from "C:\xampp\htdocs\shingnan\web\view\common\menu.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59d10604c427e9_37875243',
  'file_dependency' => 
  array (
    '66b002da06299ae751daa67dbf438250ed14d565' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\common\\menu.html',
      1 => 1506868412,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59d10604c427e9_37875243 ($_smarty_tpl) {
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
                    <i class="fa fa-th-list"></i><span>使用者管理</span><i class="fa fa-angle-down pull-right"></i>
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
                    <i class="fa fa-th-list"></i><span>貴賓證管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($_SESSION['user']['competence'] < 2) {?>
                    <li><a href="../controller/vipDeviceController.php?action=viewVIPAddForm"><i class="fa fa-circle-o"></i>新增貴賓證</a></li>
                    <?php }?>
                    <li><a href="../controller/vipDeviceController.php?action=viewVIPList"><i class="fa fa-circle-o"></i>設定貴賓證</a></li>
                    <?php if ($_SESSION['user']['competence'] < 2) {?>
                    <li><a href="../controller/vipDeviceController.php?action=viewVIPVoiceAddForm"><i class="fa fa-circle-o"></i>貴賓語音新增</a></li>
                    <li><a href="../controller/vipDeviceController.php?action=viewVIPVoiceList"><i class="fa fa-circle-o"></i>貴賓語音設定</a></li>
                    <li><a href="../controller/vipDeviceController.php?action=viewPiAddForm"><i class="fa fa-circle-o"></i>語音播放設定</a></li>
                    <?php }?>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>Beacon管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/beaconController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>新增Beacon</a></li>
                    <li><a href="../controller/beaconController.php?action=viewBeaconList"><i class="fa fa-circle-o"></i>Beacon列表</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>路徑管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/pathController.php?action=addPathForm"><i class="fa fa-circle-o"></i>新增路徑</a></li>
                    <li><a href="../controller/pathController.php?action=listPath"><i class="fa fa-circle-o"></i>路徑管理</a></li>
                    <li><a href="../controller/pathController.php?action=addChoosePathForm"><i class="fa fa-circle-o"></i>新增走法</a></li>
                    <li><a href="../controller/pathController.php?action=listChoosePath"><i class="fa fa-circle-o"></i>走法管理</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>圖資專案管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/projectController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>新增專案</a></li>
                    <li><a href="../controller/projectController.php?action=viewProjectList"><i class="fa fa-circle-o"></i>專案管理</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>裝置供應商管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/companyController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>新增供應商</a></li>
                    <li><a href="../controller/companyController.php?action=viewCompanyList"><i class="fa fa-circle-o"></i>供應商列表</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 3) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>行動導覽裝置管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($_SESSION['user']['competence'] < 2) {?>
                    <li><a  href="../controller/leaseController.php?action=viewLeaseList"><i class="fa fa-circle-o"></i>裝置硬體租借</a></li>
                    <?php }?>
                    <li><a href="../controller/leaseController.php?action=viewAddRent"><i class="fa fa-circle-o"></i>新增租借</a></li>
                    <li><a  href="../controller/leaseController.php?action=viewReturn"><i class="fa fa-circle-o"></i>裝置歸還</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 2) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>文青樣板管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/templateController.php?action=viewAddForm"><i class="fa fa-circle-o"></i>新增樣板</a></li>
                    <li><a href="../controller/templateController.php?action=viewTemplateList"><i class="fa fa-circle-o"></i>樣板列表</a></li>
                    <li><a href="../controller/templateController.php?action=viewAddText"><i class="fa fa-circle-o"></i>新增罐頭文字</a></li>
                    <li><a href="../controller/templateController.php?action=viewTextList"><i class="fa fa-circle-o"></i>罐頭文字管理</a></li>
                </ul>
            </li>
            <?php }?>
            <?php if ($_SESSION['user']['competence'] < 4) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>統計與報表功能</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/statisticController.php?action=viewSurveyResult"><i class="fa fa-circle-o"></i>問卷調查統計</a></li>
                    <li><a href="../controller/statisticController.php?action=viewLikeCount"><i class="fa fa-circle-o"></i>按讚統計</a></li>
                    <li><a href="../controller/statisticController.php?action=viewHipster"><i class="fa fa-circle-o"></i>文青樣板使用資料統計</a></li>
                </ul>
            </li>
            <?php }?>
            <!-- <?php if ($_SESSION['user']['competence'] < 4) {?>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>測試中</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../controller/deviceController.php?action=detailDevice&deviceID=1"><i class="fa fa-circle-o"></i>裝置</a></li>
                </ul>
            </li>
            <?php }?> -->
        </ul>
        <?php }?>
    </section>
</aside>
<?php }
}
