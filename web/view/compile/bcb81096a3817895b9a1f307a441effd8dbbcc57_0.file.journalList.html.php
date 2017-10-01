<?php
/* Smarty version 3.1.28, created on 2016-09-08 18:17:42
  from "C:\xampp\htdocs\tabc_backend_new\web\view\journal\journalList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d18f267e2348_68235134',
  'file_dependency' => 
  array (
    'bcb81096a3817895b9a1f307a441effd8dbbcc57' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\journal\\journalList.html',
      1 => 1473351459,
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
function content_57d18f267e2348_68235134 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <?php echo '<script'; ?>
 type="text/javascript">
    function showPathInformation(path_id){
        var str = '<table class="table table-striped"  width="100%">';
        str+= '<thead><tr><td>順序</td><td>區域編號</td><td>區域名稱</td><td>建立時間</td><td>最後編輯時間</td></thead><tbody>';

        <?php
$_from = $_smarty_tpl->tpl_vars['allPath']->value;
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
            if( <?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
 == path_id ){
                str += '<tr><td><?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td></tr></tbody>';
                str += '<a href="#">';
                str +=     '<button class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></button>';
                str += '</a>';
                str += '<a href="#">';
                str +=     '<button class="btn btn-sm btn-danger" onclick="#">';
                str +=         '<i class="glyphicon glyphicon-remove"></i>';
                str +=     '</button>'
                str +=  '</a>';
        document.getElementById('panel' + <?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
 ).innerHTML = str;
        }

        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>


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
                <h1>路徑列表</h1>
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
                        <div class="box">
                            <div id="allPath" class="box-body">
                                <?php
$_from = $_smarty_tpl->tpl_vars['pathCount']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_1_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_1_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                    <div class="panel panel-default">
                                        <a><div class="panel-heading" data-toggle="collapse" data-parent="#allPath" onclick="showPathInformation(<?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
)" data-target="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
" href="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
">
                                            <h4>Path ID: <?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
</h4></a>
                                        </div>
                                        <div id="collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
" class="panel-collapse collapse">
                                            <div class="panel-body" id="panel<?php echo $_smarty_tpl->tpl_vars['item']->value['path_id'];?>
">
                                            </div>
                                        </div>
                                    </div>
                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>
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
