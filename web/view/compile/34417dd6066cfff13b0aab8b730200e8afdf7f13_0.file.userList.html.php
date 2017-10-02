<?php
/* Smarty version 3.1.28, created on 2017-10-02 06:46:13
  from "C:\xampp\htdocs\shingnan\web\view\user\userList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59d1c4951c4df1_40007602',
  'file_dependency' => 
  array (
    '34417dd6066cfff13b0aab8b730200e8afdf7f13' => 
    array (
      0 => 'C:\\xampp\\htdocs\\shingnan\\web\\view\\user\\userList.html',
      1 => 1506868414,
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
function content_59d1c4951c4df1_40007602 ($_smarty_tpl) {
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
                                <h3 class="box-title">使用者列表</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr style="background-color: #00c0ef;color: #fff;">
                                            <th>ID</th>
                                            <th>E-mail</th>
                                            <th>角色權限</th>
                                            <th>註冊時間</th>
                                            <th>上次造訪</th>
                                            <th>最後更新</th>
                                            <th>操作選項</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$_from = $_smarty_tpl->tpl_vars['userData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_user_0_saved_item = isset($_smarty_tpl->tpl_vars['user']) ? $_smarty_tpl->tpl_vars['user'] : false;
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable();
$__foreach_user_0_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_user_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$__foreach_user_0_saved_local_item = $_smarty_tpl->tpl_vars['user'];
?>
                                        <tr>
                                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
</td>
                                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</td>
                                            <?php if ($_smarty_tpl->tpl_vars['user']->value['competence'] == 0) {?>
                                            <td>管理員</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['competence'] == 1) {?>
                                            <td>專案人員</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['competence'] == 2) {?>
                                            <td>櫃台人員</td>
                                            <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['competence'] == 3) {?>
                                            <td>行政人員</td>
                                            <?php }?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['create_date'];?>
</td>
                                            <?php if ($_smarty_tpl->tpl_vars['user']->value['last_login'] == '0000-00-00 00:00:00') {?>
                                            <td>未曾登入</td>
                                            <?php } else { ?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['last_login'];?>
</td>
                                            <?php }?>
                                            <td><?php echo $_smarty_tpl->tpl_vars['user']->value['lastupdate_date'];?>
</td>
                                            <td>
                                                <a href="../controller/userController.php?action=viewEditForm&userId=<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
">
                                                    <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>
                                                </a>&nbsp;
                                                <a href="#">
                                                    <button class="btn btn-sm btn-danger" onclick="deleteUser(<?php echo $_smarty_tpl->tpl_vars['user']->value['user_id'];?>
);"><i class="glyphicon glyphicon-remove"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_local_item;
}
}
if ($__foreach_user_0_saved_item) {
$_smarty_tpl->tpl_vars['user'] = $__foreach_user_0_saved_item;
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
 src="../javascript/userList.js"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
