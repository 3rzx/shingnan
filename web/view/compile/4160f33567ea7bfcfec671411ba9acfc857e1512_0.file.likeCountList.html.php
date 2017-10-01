<?php
/* Smarty version 3.1.28, created on 2017-02-09 14:09:22
  from "/var/www/html/web/view/statistic/likeCountList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_589c0792a6e938_16555569',
  'file_dependency' => 
  array (
    '4160f33567ea7bfcfec671411ba9acfc857e1512' => 
    array (
      0 => '/var/www/html/web/view/statistic/likeCountList.html',
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
function content_589c0792a6e938_16555569 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
  <head>
  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 src="../plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="../plugins/jquery.ui.datepicker-zh-TW.js"><?php echo '</script'; ?>
>
    <link href="../plugins/jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet">
    <link href="../plugins/jquery-ui-1.12.1.custom/jquery-ui.structure.css" rel="stylesheet">
    <link href="../plugins/jquery-ui-1.12.1.custom/jquery-ui.theme.css" rel="stylesheet">

    <?php echo '<script'; ?>
 language="JavaScript">
        $(document).ready(function(){ 
            $("#begin").datepicker();
            $("#end").datepicker();
        });

    <?php echo '</script'; ?>
>

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>按讚統計</h1>
        </section>

        <!-- Main content -->
        <section class="content">
  <div class="row">
  <div class="col-sm-6">
   <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">選擇特定時間</h3>
      </div>
      <form method="POST" action="../controller/statisticController.php">
        <div class="box-body">
          <label class="col-sm-1">起始</label>
          <input class="col-sm-3" id="begin" name="begin">
          <label class="col-sm-1">結束</label>
          <input class="col-sm-3" id="end" name="end">
          <input type="hidden" name="action" value="viewLikeCountDate">
        </div>
        <div class="box-body"  style="text-align: right;">
          <button class="btn btn-primary" type="submit">確定</button>
        </div>
      </form>
  </div>
  </div>    
  </div> 
  <div class="row">
    <div class="col-sm-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">模式</h3>
        </div>
        <div class="box-body">
          <table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-md-4">模式名稱</th>
                  <th class="col-md-2">閱覽數</th>
                  <th class="col-md-2">按讚數</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['modeData']->value;
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
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['mode_id'];?>
&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['read_count'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['like_count'];?>
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
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">區域</h3>
        </div>
        <div class="box-body">
          <table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-md-4">區域名稱</th>
                  <th class="col-md-2">點讚數</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['zoneData']->value;
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
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['like_count'];?>
</td>
              </tr>
              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">裝置</h3>
        </div>
        <div class="box-body">
          <table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-md-4">裝置名稱</th>
                  <th class="col-md-2">閱覽數</th>
                  <th class="col-md-2">按讚數</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['deviceData']->value;
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
              <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['read_count'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['like_count'];?>
</td>
              </tr>
              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div><!-- ./wrapper -->
  </body>


</html>
<?php }
}
