<?php
/* Smarty version 3.1.28, created on 2018-01-17 09:55:03
  from "C:\xampp\htdocs\shingnan\web\view\common\menu.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5a5f0f6752f5a6_82796417',
  'file_dependency' => 
  array (
    '66b002da06299ae751daa67dbf438250ed14d565' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\common\\menu.html',
      1 => 1516178958,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a5f0f6752f5a6_82796417 ($_smarty_tpl) {
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <?php if ($_SESSION['isLogin']) {?>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header" style="color:#FFFFFF; font-size: 24px;">功 能 列 表</li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>商品管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>品牌管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/brandController.php?action=brandAddPrepare">
                                    <i class="fa fa-gg-circle"></i>品牌新增</a>
                            </li>
                            <li>
                                <a href="../controller/brandController.php?action=brandList">
                                    <i class="fa fa-gg-circle"></i>品牌檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>風格管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/styleController.php?action=styleAddPrepare">
                                    <i class="fa fa-leaf"></i>風格新增</a>
                            </li>
                            <li>
                                <a href="../controller/styleController.php?action=styleList">
                                    <i class="fa fa-leaf"></i>風格檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>商品管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/frameController.php?action=frameAddPrepare">
                                    <i class="fa fa-tripadvisor"></i> 鏡框新增</a>
                            </li>
                            <li>
                                <a href="../controller/frameController.php?action=frameList">
                                    <i class="fa fa-tripadvisor"></i> 鏡框檢視/修改</a>
                            </li>
                            <li>
                                <a href="../controller/glassController.php?action=glassAddPrepare">
                                    <i class="fa fa-circle-o"></i> 鏡片新增</a>
                            </li>
                            <li>
                                <a href="../controller/glassController.php?action=glassList">
                                    <i class="fa fa-circle-o"></i> 鏡片檢視/修改</a>
                            </li>
                            <li>
                                <a href="../controller/lenController.php?action=lenAddPrepare">
                                    <i class="fa fa-eye"></i>隱形眼鏡新增</a>
                            </li>
                            <li>
                                <a href="../controller/lenController.php?action=lenList">
                                    <i class="fa fa-eye"></i>隱形眼鏡檢視/修改</a>
                            </li>
                            <li>
                                <a href="../controller/partController.php?action=partAddPrepare">
                                    <i class="fa fa-wrench"></i>零件新增</a>
                            </li>
                            <li>
                                <a href="../controller/partController.php?action=partList">
                                    <i class="fa fa-wrench"></i>零件檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>會員管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/userController.php?action=userAddPrepare">
                            <i class="fa fa-user"></i>會員新增</a>
                    </li>
                    <li>
                        <a href="../controller/userController.php?action=userSearchPrepare">
                            <i class="fa fa-user"></i>會員搜尋</a>
                    </li>
                    <li>
                        <a href="../controller/userController.php?action=userSearchPrepare">
                            <i class="fa fa-shopping-cart"></i>會員購物紀錄新增</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>點數管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/pointController.php?action=pointEditPrepare">
                            <i class="fa fa-star"></i>修改點數匯率</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>文章管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>衛教管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/educationController.php?action=educationAddPrepare">
                                    <i class="fa fa-file-image-o"></i>衛教文章新增</a>
                            </li>
                            <li>
                                <a href="../controller/educationController.php?action=educationList">
                                    <i class="fa fa-file-image-o"></i>衛教文章檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>趨勢新知管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/newsController.php?action=newsAddPrepare">
                                    <i class="fa fa-file-video-o"></i>趨勢新知文章新增</a>
                            </li>
                            <li>
                                <a href="../controller/newsController.php?action=newsList">
                                    <i class="fa fa-file-video-o"></i>趨勢新知文章檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-align-justify"></i>興南生活管理
                            <i class="fa fa-angle-down pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="../controller/lifeController.php?action=lifeAddPrepare">
                                    <i class="fa fa-file-text-o"></i>興南生活文章新增</a>
                            </li>
                            <li>
                                <a href="../controller/lifeController.php?action=lifeList">
                                    <i class="fa fa-file-text-o"></i>興南生活文章檢視/修改</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>課程管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/courseController.php?action=courseAddPrepare">
                            <i class="fa fa-graduation-cap"></i>課程資訊新增</a>
                    </li>
                    <li>
                        <a href="../controller/courseController.php?action=courseList">
                            <i class="fa fa-graduation-cap"></i>課程資訊檢視/修改</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>店家管理</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/storeController.php?action=storeAddPrepare">
                            <i class="fa fa-home"></i>店家資料專案</a>
                    </li>
                    <li>
                        <a href="../controller/storeController.php?action=storeList">
                            <i class="fa fa-home"></i>店家資料檢視/修改管理</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>統計與報表功能</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/statisticController.php?action=orderHistory">
                            <i class="fa fa-bar-chart"></i>消費記錄統計
                        </a>
                    </li>
                    <li>
                        <a href="../controller/statisticController.php?action=goodsClick">
                            <i class="fa fa-bar-chart"></i>商品點擊率統計
                        </a>
                    </li>
                    <li>
                        <a href="../controller/statisticController.php?action=articleClick">
                            <i class="fa fa-bar-chart"></i>文章點擊率統計
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>前台頁面設定</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="../controller/uiController.php?action=viewIndexCover">
                            <i class="fa fa-gear"></i>首頁圖片檢視
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php }?>
    </section>
</aside><?php }
}
