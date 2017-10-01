<?php
/* Smarty version 3.1.28, created on 2017-09-04 15:27:36
  from "/var/www/html/web/view/field/fieldDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59ad006898b437_55315373',
  'file_dependency' => 
  array (
    '9e6519c536de42ef9cc0913ea7465e07cdc548e9' => 
    array (
      0 => '/var/www/html/web/view/field/fieldDetail.html',
      1 => 1481103525,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../common/resource.html' => 1,
    'file:../common/header.html' => 1,
    'file:../common/menu.html' => 1,
    'file:../common/footer.html' => 1,
  ),
),false)) {
function content_59ad006898b437_55315373 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>場域詳細資料</h1>
                <ol class="breadcrumb">
                    <li><a href="../controller/projectController.php?action=viewProjectDetail&projectId=<?php echo $_smarty_tpl->tpl_vars['field']->value['project_id'];?>
"><i class="fa fa-arrow-right"></i>回到專案詳細資料</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?> <?php if ($_smarty_tpl->tpl_vars['msg']->value != '') {?>
                        <div class="alert alert-success alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">
                                    場域編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>

                                    <a href="../controller/fieldController.php?action=viewEditForm&fieldId=<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
&projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['project_id'];?>
">&nbsp;
                                        <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                    </a>
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-2">欄位</th>
                                            <th>資料</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['field']->value['name_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>簡介</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['field']->value['introduction'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>場域圖片(平板)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['photo'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>場域圖片(App)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['photo_vertical'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>場域地圖</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_svg'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>場域地圖(英文)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_svg_en'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>場域地圖背景</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['field']->value['map_bg'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>建立時間</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['field']->value['create_date'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>最近編輯</td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['field']->value['lastupdate_date'];?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">
                                區域列表&nbsp;&nbsp;<a href="../controller/zoneController.php?action=viewAddForm&fieldId=<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-xs-1">區域ID</th>
                                            <th class="col-xs-1">區域名稱</th>
                                            <th class="col-xs-1">英文名稱</th>
                                            <th class="col-xs-5">區域介紹</th>
                                            <th class="col-xs-1">建立時間</th>
                                            <th class="col-xs-1">最近編輯</th>
                                            <th class="col-xs-2">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['zone']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_0_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_0_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name_en'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['introduction'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/zoneController.php?action=viewZoneDetail&zoneId=<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
">
                                                    <button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                                </a>&nbsp;
                                                <a href="../controller/zoneController.php?action=viewEditForm&fieldId=<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
&zoneId=<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteZone(<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
);"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- beacon list -->
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">Beacon列表&nbsp;&nbsp;<a href="../controller/fieldController.php?action=viewBeaconAddForm&fieldId=<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th>ID</th>
                                            <th>Beacon Mac</th>
                                            <th>名稱</th>
                                            <th>電量</th>
                                            <th>隸屬分區編號</th>
                                            <th>紀錄佈建狀態</th>
                                            <th>X座標</th>
                                            <th>Y座標</th>
                                            <th>註冊時間</th>
                                            <th>最後更新</th>
                                            <th class="col-xs-1">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['beaconData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_beacon_1_saved_item = isset($_smarty_tpl->tpl_vars['beacon']) ? $_smarty_tpl->tpl_vars['beacon'] : false;
$_smarty_tpl->tpl_vars['beacon'] = new Smarty_Variable();
$__foreach_beacon_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_beacon_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['beacon']->value) {
$__foreach_beacon_1_saved_local_item = $_smarty_tpl->tpl_vars['beacon'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['beacon_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['mac_addr'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['name'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['power'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['zone_name'];?>
</td>
                                            <?php if ($_smarty_tpl->tpl_vars['beacon']->value['status'] == 0) {?>
                                            <td>預設</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['beacon']->value['status'] == 1) {?>
                                            <td>未佈置</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['beacon']->value['status'] == 2) {?>
                                            <td>待確認</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['beacon']->value['status'] == 3) {?>
                                            <td>已確認</td>
                                            <?php }?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['x'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['y'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['beacon']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/fieldController.php?action=viewBeaconEditForm&beaconId=<?php echo $_smarty_tpl->tpl_vars['beacon']->value['beacon_id'];?>
&fieldId=<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteBeacon(<?php echo $_smarty_tpl->tpl_vars['field']->value['field_map_id'];?>
,<?php echo $_smarty_tpl->tpl_vars['beacon']->value['beacon_id'];?>
);"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['beacon'] = $__foreach_beacon_1_saved_local_item;
}
}
if ($__foreach_beacon_1_saved_item) {
$_smarty_tpl->tpl_vars['beacon'] = $__foreach_beacon_1_saved_item;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <?php echo '<script'; ?>
 src="../javascript/fieldDetail.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
