<?php
/* Smarty version 3.1.28, created on 2017-01-21 14:17:05
  from "/var/www/html/web/view/vipDevice/vipVoiceAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_5882fce145cf70_08909285',
  'file_dependency' => 
  array (
    '2c7f0ef891ed758220ed036e0b82a10c6008561d' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipVoiceAdd.html',
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
function content_5882fce145cf70_08909285 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
    $(document).ready(function() {

        $("#VIPvoice").filestyle({
            size: "nr",
            input: false,
            buttonText: "上傳語音",
            buttonName: "btn-success",
            iconName: "glyphicon glyphicon-music"
         });

        $("#VIPvoice").change(function() {
        readURL(this, '#voiceAudio');
        });

        
    });


    function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id).attr('src', e.target.result);
                $(id).css('display', '');
            }
            reader.readAsDataURL(input.files[0]);
        }
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
                                <h3 class="box-title">新增貴賓證語音</h3>
                            </div>
                            <!-- form-->
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/vipDeviceController.php">
                            	<div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">語音名稱</label>
                                        <div class="col-sm-10">
                                            <input id="voiceName" name="voiceName" type="text" class="form-control"placeholder="輸入語音名稱">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">上傳語音</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="VIPvoice" name="VIPvoice" data-input="false" accept="audio/*">
                                            <audio controls id="voiceAudio" style="display:none"></audio>
                                        </div>
                                    </div>
                                </div>
                            	<div class="box-footer" style="text-align: right;">
                                    <a href="../controller/userController.php?action=main" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="addVipVoice">
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
