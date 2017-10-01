<?php
/* Smarty version 3.1.28, created on 2017-08-22 13:09:18
  from "/var/www/html/web/view/company/companyList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_599bbc7ec3c277_28367741',
  'file_dependency' => 
  array (
    '015e4c3a9d4ea969a1d730bf20b8c70cece44b79' => 
    array (
      0 => '/var/www/html/web/view/company/companyList.html',
      1 => 1481690901,
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
function content_599bbc7ec3c277_28367741 ($_smarty_tpl) {
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
                                <h3 class="box-title">公司列表</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th >ID</th>
                                            <th class="col-xs-1">名稱</th>
                                            <th class="col-xs-1">英文名稱</th>
                                            <th class="col-xs-1">電話</th>
                                            <th class="col-xs-1">傳真</th>
                                            <th class="col-xs-2">地址</th>
                                            <th >網頁</th>
                                            <th class="col-xs-1">QR</th>
                                            <th ">註冊時間</th>
                                            <th ">最後更新</th>
                                            <th ">操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['companyData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_company_0_saved_item = isset($_smarty_tpl->tpl_vars['company']) ? $_smarty_tpl->tpl_vars['company'] : false;
$_smarty_tpl->tpl_vars['company'] = new Smarty_Variable();
$__foreach_company_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_company_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
$__foreach_company_0_saved_local_item = $_smarty_tpl->tpl_vars['company'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['company_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['name'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['name_en'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['tel'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['fax'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['addr'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['web'];?>
</td>
                                            <td>
                                                <?php if ($_smarty_tpl->tpl_vars['company']->value['qrcode'] != '') {?>
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['company']->value['qrcode'];?>
" width="100%" />
                                                <?php }?>
                                            </td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['create_date'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['company']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/companyController.php?action=viewEditForm&companyId=<?php echo $_smarty_tpl->tpl_vars['company']->value['company_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteCompany(<?php echo $_smarty_tpl->tpl_vars['company']->value['company_id'];?>
);"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['company'] = $__foreach_company_0_saved_local_item;
}
}
if ($__foreach_company_0_saved_item) {
$_smarty_tpl->tpl_vars['company'] = $__foreach_company_0_saved_item;
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
 src="../javascript/companyList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
