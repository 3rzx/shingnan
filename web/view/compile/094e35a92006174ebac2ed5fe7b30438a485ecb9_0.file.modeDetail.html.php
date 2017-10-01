<?php
/* Smarty version 3.1.28, created on 2017-09-04 15:27:56
  from "/var/www/html/web/view/mode/modeDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59ad007c051e52_89322251',
  'file_dependency' => 
  array (
    '094e35a92006174ebac2ed5fe7b30438a485ecb9' => 
    array (
      0 => '/var/www/html/web/view/mode/modeDetail.html',
      1 => 1480162352,
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
function content_59ad007c051e52_89322251 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 src="../javascript/deviceDelete.js"><?php echo '</script'; ?>
>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>展項詳細資料</h1>
                <ol class="breadcrumb">
                    <li><a href="../controller/zoneController.php?action=viewZoneDetail&zoneId=<?php echo $_smarty_tpl->tpl_vars['modeData']->value['zone_id'];?>
"><i class="fa fa-arrow-right"></i>回到區域詳細資料</a></li>
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
                        <?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['msg']->value != '') {?>
                        <div class="alert alert-success alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">展項編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
</h3>&nbsp;&nbsp;
                                <a href="../controller/modeController.php?action=editModeForm&modeID=<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
">
                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                </a>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-2">屬性</th>
                                            <th>設定值</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['name_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>簡介</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['introduction'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文簡介</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['introduction_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>隸屬區域</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['zone_id'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>影片</td>
                                            <td>
                                                <iframe id="ytplayer" type="text/html" width="500" height="300"src="http://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['modeVideo']->value;?>
?autoplay=0&origin=http://example.com"frameborder="0"></iframe>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>導覽語音</td>
                                            <td>
                                                <audio controls src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['guide_voice'];?>
"></audio>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>英文導覽語音</td>
                                            <td>
                                                <audio controls src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['guide_voice_en'];?>
"></audio>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>過場圖片(背景)</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_bg'];?>
" alt="尚未上傳圖片"class="img-thumbnail"></td>
                                        </tr>
                                        <tr>
                                            <td>直式過場圖片(背景)</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_bg_vertical'];?>
" alt="尚未上傳圖片"class="img-thumbnail"></td>
                                        </tr>
                                        <tr>
                                            <td>過場圖片(強調高亮)</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_fg'];?>
" alt="尚未上傳圖片"class="img-thumbnail"></td>
                                        </tr>
                                        <tr>
                                            <td>直式過場圖片(強調高亮)</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_fg_vertical'];?>
" alt="尚未上傳圖片"class="img-thumbnail"></td>
                                        </tr>
                                        <tr>
                                            <td>過場圖片(模糊)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_blur'];?>
" alt="尚未上傳圖片"class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>直式過場圖片(模糊)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_blur_vertical'];?>
" alt="尚未上傳圖片"class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>建立時間</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['create_date'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>最近編輯</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['modeData']->value['lastupdate_date'];?>
</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">裝置列表&nbsp;&nbsp;<a href="../controller/deviceController.php?action=addDeviceForm&modeID=<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
"><button class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
                                </a>
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-1">裝置ID</th>
                                            <th class="col-md-1">裝置名稱</th>
                                            <th class="col-md-1">英文名稱</th>
                                            <th class="col-md-2">供應廠商</th>
                                            <th class="col-md-2">建立時間</th>
                                            <th class="col-md-2">最近編輯</th>
                                            <th class="col-md-2">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['deviceData']->value;
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
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['DName'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name_en'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['company_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['CName'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/deviceController.php?action=detailDevice&deviceID=<?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
">
                                                    <button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                                </a>&nbsp;
                                                <a href="../controller/deviceController.php?action=editDeviceForm&deviceID=<?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteDevice(<?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
)"><i class="glyphicon glyphicon-remove"></i></button>
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
                    </div>
                </div>
            </section>
        </div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
</body>

</html>
<?php }
}
