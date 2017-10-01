<?php
/* Smarty version 3.1.28, created on 2017-09-04 15:27:50
  from "/var/www/html/web/view/zone/zoneDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59ad00762ba3f5_01998779',
  'file_dependency' => 
  array (
    'ee173d1bba71a4be2860ba29aeacfd1b50cd41b5' => 
    array (
      0 => '/var/www/html/web/view/zone/zoneDetail.html',
      1 => 1480231780,
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
function content_59ad00762ba3f5_01998779 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 src="../javascript/zoneDetail.js"><?php echo '</script'; ?>
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
                <h1>區域詳細資料</h1>
                <ol class="breadcrumb">
                    <li><a href="../controller/fieldController.php?action=viewFieldDetail&fieldId=<?php echo $_smarty_tpl->tpl_vars['zone']->value['field_id'];?>
"><i class="fa fa-arrow-right"></i>回到場域詳細資料</a></li>
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
                            <div class="box-header">
                                <h3 class="box-title">
                                    區域編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['zone']->value['zone_id'];?>

                                    <a href="../controller/zoneController.php?action=viewEditForm&fieldId=<?php echo $_smarty_tpl->tpl_vars['zone']->value['field_id'];?>
&zoneId=<?php echo $_smarty_tpl->tpl_vars['zone']->value['zone_id'];?>
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
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['name_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>簡介</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['introduction'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>簡介(英文)</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['introduction_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>導覽語音</td>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['zone']->value['guide_voice'] == null) {?>
                                                尚無語音檔
                                                <?php } else { ?>
                                                <audio controls src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['guide_voice'];?>
" type="audio/*">
                                                </audio>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>導覽語音(英文)</td>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['zone']->value['guide_voice_en'] == null) {?>
                                                尚無語音檔
                                                <?php } else { ?>
                                                <audio controls src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['guide_voice_en'];?>
" type="audio/*">
                                                </audio>
                                                <?php }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>提示</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['hint'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>區域圖片(平板)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['photo'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>區域圖片(App)</td>
                                            <td>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['zone']->value['photo_vertical'];?>
" class="img-thumbnail">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>建立時間</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['create_date'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>最近編輯</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['zone']->value['lastupdate_date'];?>
</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title">
                                展項列表&nbsp;&nbsp;<a href="../controller/modeController.php?action=addModeForm&zoneID=<?php echo $_smarty_tpl->tpl_vars['zone']->value['zone_id'];?>
" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
                                </h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-xs-1">模式ID</th>
                                            <th class="col-xs-1">模式名稱</th>
                                            <th class="col-xs-1">英文名稱</th>
                                            <th class="col-xs-5">模式介紹</th>
                                            <th class="col-xs-1">建立時間</th>
                                            <th class="col-xs-1">最近編輯</th>
                                            <th class="col-xs-2">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['mode']->value;
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
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
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
                                                <a href="../controller/modeController.php?action=detailMode&modeID=<?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
">
                                                    <button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                                </a>&nbsp;
                                                <a href="../controller/modeController.php?action=editModeForm&modeID=<?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteMode(<?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
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
