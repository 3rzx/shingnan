<?php
/* Smarty version 3.1.28, created on 2017-08-22 13:08:32
  from "/var/www/html/web/view/device/deviceDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599bbc50882b55_40115855',
  'file_dependency' => 
  array (
    'e68ac0706504d671e7c909158551f42be31c35e3' => 
    array (
      0 => '/var/www/html/web/view/device/deviceDetail.html',
      1 => 1481903758,
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
function content_599bbc50882b55_40115855 ($_smarty_tpl) {
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
                <h1>裝置詳細資料</h1>
                <ol class="breadcrumb">
                    <li><a href="../controller/modeController.php?action=detailMode&modeID=<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['mode_id'];?>
"><i class="fa fa-arrow-right"></i>回到展項詳細資料</a></li>
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
                        <div class="box box-info" >
                            <div class="box-header with-border">
                                <h3 class="box-title">裝置編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
</h3>&nbsp;&nbsp; 
                                <a href="../controller/deviceController.php?action=editDeviceForm&deviceID=<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
">
                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                </a>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-1">屬性</th>
                                            <th>設定值</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['name_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>簡介</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['introduction'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>裝置提示</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['hint'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>隸屬展項</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['mode_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['modeData']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>導覽語音</td>
                                            <td><audio controls src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['guide_voice'];?>
" ></td>
                                        </tr>
                                        <tr>
                                            <td>英文導覽語音</td>
                                            <td><audio controls src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['guide_voice_en'];?>
" ></td>
                                        </tr>
                                        <tr>
                                            <td>裝置圖片</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['photo'];?>
" alt="裝置圖片"class="img-thumbnail" class="img-thumbnail"></td>
                                        </tr>
                                        <tr>
                                            <td>直式裝置圖片</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['photo_vertical'];?>
" alt="直式裝置圖片" class="img-thumbnail"></td>
                                        </tr> 
                                        <tr>
                                            <td>建立時間</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['create_date'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>最近編輯</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['lastupdate_date'];?>
</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">提供公司編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['companyData']->value['company_id'];?>
</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th class="col-md-1">屬性</th>
                                            <th>設定值</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['name'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>英文名稱</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['name_en'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>電話</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['tel'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>傳真 </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['fax'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>地址</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['addr'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>網頁</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['web'];?>
</td>
                                        </tr>
                                         <tr>
                                            <td>QRcode</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['companyData']->value['qrcode'];?>
"/></td>
                                        </tr>
                                        <tr>
                                            <td>建立時間</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['create_date'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>最近編輯</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['lastupdate_date'];?>
</td>
                                        </tr>
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
