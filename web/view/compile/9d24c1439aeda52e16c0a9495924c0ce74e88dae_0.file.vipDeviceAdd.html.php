<?php
/* Smarty version 3.1.28, created on 2017-08-22 22:01:22
  from "/var/www/html/web/view/vipDevice/vipDeviceAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599c39326277e5_93370058',
  'file_dependency' => 
  array (
    '9d24c1439aeda52e16c0a9495924c0ce74e88dae' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipDeviceAdd.html',
      1 => 1480561711,
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
function content_599c39326277e5_93370058 ($_smarty_tpl) {
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
        		<h1></h1>
        	</section>
        	<section class="content">
        		<div class="row">
        			<div class="col-md-6">
        				<?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
                        <div class="alert alert-warning alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box box-primary">
                        	<div class="box-header with-border">
                                <h3 class="box-title">新增貴賓證</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" method="post" action="../controller/vipDeviceController.php">
                            	<div class="box-body">
                                    <div id="vipDeviceHuDiv" class="form-group">
                                        <label for="vipDeviceHu" class="col-sm-2 control-label">編號</label>
                                        <div class="col-sm-10">
                                            <input id="HuId" name="HuId" type="text" class="form-control"placeholder="輸入貴賓證編號">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="vipDeviceDiv" class="form-group">
                                        <label for="macAddrDiv" class="col-sm-2 control-label">識別碼</label>
                                        <div class="col-sm-10">
                                            <input id="macAddr" name="macAddr" type="text" class="form-control" minLength="6" placeholder="輸入貴賓證識別碼">
                                        </div>
                                    </div>
                            	</div>
                            	<div class="box-footer" style="text-align: right;">
                                    <a href="../controller/userController.php?action=main" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addVipDevice">
                                    <button type="submit" class="btn btn-primary">確定</button>
                                </div>

                            </form>
                        </div>
        			</div>
        		</div>
        	</section>
        </div>
        <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	</div>
</body>
</html><?php }
}
