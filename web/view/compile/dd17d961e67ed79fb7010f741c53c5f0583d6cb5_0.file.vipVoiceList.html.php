<?php
/* Smarty version 3.1.28, created on 2016-12-06 17:32:49
  from "/var/www/html/web/view/vipDevice/vipVoiceList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_584685c1a96d23_01123758',
  'file_dependency' => 
  array (
    'dd17d961e67ed79fb7010f741c53c5f0583d6cb5' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipVoiceList.html',
      1 => 1480561713,
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
function content_584685c1a96d23_01123758 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
>
    function deleteVoice(voiceID){
        BootstrapDialog.show({
            title:'提醒',
            message: '確定刪除裝置嗎?',
            buttons: [{
                label: '確定',
                cssClass: 'btn-danger',
                action: function(){
                    location='../controller/vipDeviceController.php?action=deleteVIPVoice&voiceID='+ voiceID ;
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
                <h1></h1>
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
                        <div class="box box-primary">
                        	<div class="box-header">
                                <h3 class="box-title">貴賓證語音列表</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th>貴賓語音編號</th>
                                            <th>語音檔案</th>
                                            <th>語音名稱</th>
                                            <th>最後更新時間</th>
                                            <th>建立時間</th>
                                            <th>修改<th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['vipVoiceData']->value;
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
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['voice_id'];?>
</td>
                                            <td><audio controls src="<?php echo $_smarty_tpl->tpl_vars['item']->value['voice'];?>
"></audio></td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['voice_name'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td>
                                            <td>
                                                <a href="../controller/vipDeviceController.php?action=viewVIPVoiceEditForm&voiceID=<?php echo $_smarty_tpl->tpl_vars['item']->value['voice_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteVoice(<?php echo $_smarty_tpl->tpl_vars['item']->value['voice_id'];?>
)" ><i class="glyphicon glyphicon-remove"></i></button>
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
	<?php echo '<script'; ?>
 src="../javascript/vipDeviceList.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
