<?php
/* Smarty version 3.1.28, created on 2016-09-12 11:44:05
  from "C:\xampp\htdocs\backend\web\view\device\deviceDetail.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d62485d5d8a9_45586618',
  'file_dependency' => 
  array (
    '69450ccec00f76b2bb38ab010456ad682ffde948' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\device\\deviceDetail.html',
      1 => 1473613000,
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
function content_57d62485d5d8a9_45586618 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php echo '<script'; ?>
 type="text/javascript">
    function delectDevice(deviceID){
        BootstrapDialog.show({
            title:'提醒',
            message: '確定刪除路線嗎?',
            buttons: [{
                label: '確定',
                cssClass: 'btn-danger',
                action: function(){
                    location='../controller/deviceController.php?action=delectDevice&deviceID='+ deviceID ;
                }
            },{
                label: '取消',
                action: function(dialogItself){
                    dialogItself.close();
                }
            }]
        });
    }
<?php echo '</script'; ?>
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
                <h1>裝置詳細資料</h1>
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
                                <h3 class="box-title">裝置編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['device_id'];?>
</h3>&nbsp;&nbsp; 
                                <a href="../controller/deviceController.php?action=editDeviceForm&deviceID=1">
                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                </a>
                                <a href="../controller/deviceController.php?action=addDeviceForm">
                                    <button class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
                                </a>
                                <a>
                                    <button class="btn btn-sm btn-danger" onclick="delectDevice(1)"><i class="glyphicon glyphicon-remove"></i></button>
                                </a>
                                <a href="../controller/deviceController.php?action=detailDevice&deviceID=1">
                                    <button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-search"></i></button>
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
                                            <td>提示</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['hint'];?>
"></td>
                                        </tr>
                                        <tr>
                                            <td>隸屬展項</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['deviceData']->value['mode'];?>
</td>
                                        </tr>
                                        <tr>
                                            <td>圖片</td>
                                            <td><img src="<?php echo $_smarty_tpl->tpl_vars['deviceData']->value['photo'];?>
" alt="圖片"class="img-thumbnail"></td>
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
                                            <td>QRcode</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['companyData']->value['qrcode'];?>
</td>
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
