<?php
/* Smarty version 3.1.28, created on 2017-10-02 08:21:44
  from "C:\xampp\htdocs\shingnan\web\view\common\menu.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59d1daf80342e7_83615271',
  'file_dependency' => 
  array (
    '66b002da06299ae751daa67dbf438250ed14d565' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\common\\menu.html',
      1 => 1506923029,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59d1daf80342e7_83615271 ($_smarty_tpl) {
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
                    <i class="fa fa-th-list"></i><span>商品管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-align-justify"></i>風格管理<i class="fa fa-angle-down pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-leaf"></i>風格新增</a></li>
                            <li><a href="#"><i class="fa fa-leaf"></i>風格檢視/修改</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-align-justify"></i>商品管理<i class="fa fa-angle-down pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-tripadvisor"></i> 鏡框新增</a></li>
                            <li><a href="#"><i class="fa fa-tripadvisor"></i> 經框檢視/修改</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> 鏡片新增</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> 經片檢視/修改</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i>隱形眼鏡新增</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i>隱形眼鏡檢視/修改</a></li>
                            <li><a href="#"><i class="fa fa-wrench"></i>零件新增</a></li>
                            <li><a href="#"><i class="fa fa-wrench"></i>零件檢視/修改</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>會員管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-user"></i>會員新增</a>
                    </li>
                    <li><a href="#"><i class="fa fa-user"></i>會員檢視/修改</a>
                    </li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>會員購物紀錄新增</a>
                    </li>
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>會員購物紀錄檢視/修改</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>文章管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-align-justify"></i>衛教管理<i class="fa fa-angle-down pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-file-image-o"></i>衛教文章新增</a></li>
                            <li><a href="#"><i class="fa fa-file-image-o"></i>衛教文章檢視/修改</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-align-justify"></i>趨勢新知管理<i class="fa fa-angle-down pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-file-video-o"></i>趨勢新知文章新增</a></li>
                            <li><a href="#"><i class="fa fa-file-video-o"></i>趨勢新知文章檢視/修改</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-align-justify"></i>興南生活管理<i class="fa fa-angle-down pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-file-text-o"></i>興南生活文章新增</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i>興南生活文章檢視/修改</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>課程管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-graduation-cap"></i>課程資訊新增</a></li>
                    <li><a href="#"><i class="fa fa-graduation-cap"></i>課程資訊檢視/修改</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>店家管理</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-home"></i>店家資料專案</a></li>
                    <li><a href="#"><i class="fa fa-home"></i>店家資料檢視/修改管理</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i><span>統計與報表功能</span><i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-bar-chart"></i>問卷調查統計</a></li>
                    <li><a href="#"><i class="fa fa-bar-chart"></i>按讚統計</a></li>
                    <li><a href="#"><i class="fa fa-bar-chart"></i>文青樣板使用資料統計</a></li>
                </ul>
            </li>
            <?php }?>
        </ul>
        <?php }?>
    </section>
</aside>
<?php }
}
