<?php
/* Smarty version 3.1.28, created on 2017-02-23 11:41:07
  from "/var/www/html/web/view/path/choosePathList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58ae59d3e1c9c3_51804368',
  'file_dependency' => 
  array (
    '735d97d91bb4495af2ef9a3b2dfd960021eb366c' => 
    array (
      0 => '/var/www/html/web/view/path/choosePathList.html',
      1 => 1476548762,
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
function content_58ae59d3e1c9c3_51804368 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <?php echo '<script'; ?>
 type="text/javascript">
    

    function showPathInformation(choose_path_id){
        var str = '<table class="table table-striped"  width="100%">';
        str += '<thead><tr><td>順序</td><td>SVG編號</td><td>起始區域編號</td><td>起始區域名稱</td><td>目的區域編號</td><td>目的區域名稱</td><td>建立時間</td><td>最後編輯時間</td></thead><tbody>';
        

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
            if( <?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
 == choose_path_id ){
                str += '<tr><td><?php echo $_smarty_tpl->tpl_vars['item']->value['order'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['svg_id'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['start'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['Sn'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['end'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['En'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td></tr>';    
        }
        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>

        str += '<a href="../controller/pathController.php?action=editChoosePathForm&choosePathID='+ choose_path_id + '">';
        str +=     '<button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-pencil"></i></button>';
        str += '</a>&nbsp;&nbsp;';
        str += '<a>';
        str +=     '<button class="btn btn-sm btn-danger" onclick="deleteChoosePath(' + choose_path_id + ')">';
        str +=         '<i class="glyphicon glyphicon-remove"></i>'; 
        str +=     '</button>'
        str +=  '</a>';
        str += '</tbody>';
        document.getElementById('panel' + choose_path_id ).innerHTML = str;
    }

    function deleteChoosePath(choose_path_id){
        if(choose_path_id == <?php echo $_smarty_tpl->tpl_vars['pathUsed']->value;?>
 ){
            BootstrapDialog.alert('路徑使用中無法刪除');
        }else{
            BootstrapDialog.show({
                title:'提醒',
                message: '確定刪除路線嗎?',
                buttons: [{
                    label: '確定',
                    cssClass: 'btn-danger',
                    action: function(){
                        location='../controller/pathController.php?action=deleteChoosePath&choosePathID='+ choose_path_id ;
                    }
                },{
                    label: '取消',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });
        }
    }

    function editPathUsed(){
        var path = $('#pathUsed').val();
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
            if(path == <?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
){
                location='../controller/pathController.php?action=editPathUsed&pathId='+ path ;
                return;
            }
        <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>
            BootstrapDialog.alert('該路徑編號不存在')
    }

    function cleanPathUsed(){
        $('#pathUsed').val("");
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
                <h1>走法列表</h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-8">
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
                                <h3 class="box-title">APP使用走法設定</h3>
                            </div>
                            <div class="box-body">
                                <label class="col-sm-2 control-label">目前APP使用走法: </label>
                                <label class="col-sm-10 control-label"><?php echo $_smarty_tpl->tpl_vars['pathUsed']->value;?>
</label> 
                                <label class="col-sm-2 control-label">修改APP使用走法: </label>
                                <div class="col-sm-4">
                                    <input type="text"  class="form-control" id="pathUsed" name="pathUsed" placeholder="請輸入走法編號(ex:1)"/>
                                </div>
                            </div>
                            <div class="box-footer" style="text-align: right;">
                                <button onclick="cleanPathUsed();" class="btn btn-warning">取消</button>
                                <button onclick="editPathUsed()" class="btn btn-primary">確定</button>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">走法管理</h3>
                            </div>
                            <div id="allPath" class="box-body">
                                <?php
$_from = $_smarty_tpl->tpl_vars['pathCount']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_2_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_2_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_2_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                                    <div class="panel panel-default">
                                        <a><div class="panel-heading" data-toggle="collapse" data-parent="#allPath" onclick="showPathInformation(<?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
)" data-target="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
" href="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
">
                                            <h4><b>All path ID: <?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
</b></h4></a>
                                        </div>
                                        <div id="collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
" class="panel-collapse collapse">
                                            <div class="panel-body" id="panel<?php echo $_smarty_tpl->tpl_vars['item']->value['choose_path_id'];?>
">
                                            </div>
                                        </div>
                                    </div>
                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
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
