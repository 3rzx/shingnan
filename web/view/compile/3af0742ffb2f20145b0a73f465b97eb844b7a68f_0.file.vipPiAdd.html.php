<?php
/* Smarty version 3.1.28, created on 2016-12-19 16:47:38
  from "/var/www/html/web/view/vipDevice/vipPiAdd.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58579eaa237972_61376210',
  'file_dependency' => 
  array (
    '3af0742ffb2f20145b0a73f465b97eb844b7a68f' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipPiAdd.html',
      1 => 1481079668,
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
function content_58579eaa237972_61376210 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
>
        $(document).ready(function(){
            scan();
        });
        function scan() {
            // 送scan請求給server
            var url = '../scanPi.php';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var res = xmlhttp.responseText;
                    // alert(res);
                }
            }
            xmlhttp.send();

            var temp = BootstrapDialog.show({
                type: 'type-default',
                title: '掃描裝置中(等待15s)...',
                closable: false,
                message: '<div class="progress"><div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div>'
            });
            var i = 0;
            var counterBack = setInterval(function() {
                i++;
                if (i <= 15) {
                    $('.progress-bar').css('width', i * (100 / 15) + '%');
                } else {
                    clearInterval(counterBack);
                    temp.close();
                    location = "../controller/vipDeviceController.php?action=viewVIPPiList";
                }

            }, 1000);
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
                        <!-- <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">掃描語音撥放裝置</h3>
                            </div>
                            <form class="form-horizontal" method="post">
                                <div class="box-footer">
                                    <button type="button" class="btn btn-primary" onclick="scan();"><i class="fa fa-fw fa-spinner"></i>&nbsp;掃描裝置</button>
                                </div>
                            </form>
                        </div> -->
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
