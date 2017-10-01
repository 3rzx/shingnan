<?php
/* Smarty version 3.1.28, created on 2017-02-13 17:57:59
  from "/var/www/html/web/view/statistic/hipsterList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58a1832799cce1_31791775',
  'file_dependency' => 
  array (
    '7a78d01670be1d806ceb93967d4831a5d5aaf308' => 
    array (
      0 => '/var/www/html/web/view/statistic/hipsterList.html',
      1 => 1486616527,
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
function content_58a1832799cce1_31791775 ($_smarty_tpl) {
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
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info" >
                            <div class="box-header with-border">
                                    <h3 class="box-title">文青樣板使用資料統計</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th >ID</th>
                                            <th class="col-md-2">文字</th>
                                            <th class="col-md-1">樣板編號</th>
                                            <th class="col-md-2">罐頭文字編號</th>
                                            <th >建立時間</th>
                                            <th >最後更新</th>
                                            <th >顯示圖片</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['hipster_contentData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_hipster_content_0_saved_item = isset($_smarty_tpl->tpl_vars['hipster_content']) ? $_smarty_tpl->tpl_vars['hipster_content'] : false;
$_smarty_tpl->tpl_vars['hipster_content'] = new Smarty_Variable();
$__foreach_hipster_content_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_hipster_content_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['hipster_content']->value) {
$__foreach_hipster_content_0_saved_local_item = $_smarty_tpl->tpl_vars['hipster_content'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_content_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['content'];?>
</td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_template_id'];?>

                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_text_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['create_date'];?>
</td> 
                                            <td><?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="#">
                                                    <button id="showPic" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-picture"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr id="showPic" class="collapse">
                                            <td colspan="8">
                                                <div id="Pic<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_content_id'];?>
" class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            照片
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['picture'];?>
" width="100%" />
                                                    </div>
                                                </div>
                                                <div id="Comb<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_content_id'];?>
" class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            輸出
                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['combine_picture'];?>
" width="100%" />
                                                    </div>
                                                </div>
                                                <div id="Temp<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_content_id'];?>
" class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">
                                                            <?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['hipster_template_id'];?>
&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['template_name'];?>

                                                        </h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['hipster_content']->value['template_path'];?>
" width="100%" />
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['hipster_content'] = $__foreach_hipster_content_0_saved_local_item;
}
}
if ($__foreach_hipster_content_0_saved_item) {
$_smarty_tpl->tpl_vars['hipster_content'] = $__foreach_hipster_content_0_saved_item;
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
 src="../javascript/hipsterList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
