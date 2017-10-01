<?php
/* Smarty version 3.1.28, created on 2016-09-13 01:01:14
  from "C:\xampp\htdocs\backend\web\view\statistic\likeCountList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d6df5a6a2748_51775764',
  'file_dependency' => 
  array (
    '4b580070cfe79adcff82279d7dde22e436946ae1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\backend\\web\\view\\statistic\\likeCountList.html',
      1 => 1473612513,
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
function content_57d6df5a6a2748_51775764 ($_smarty_tpl) {
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



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>按讚統計</h1>
        </section>

        <!-- Main content -->
        <section class="content">
	<div class="row">
		<div class="col-xs-8">
			<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">展項</h3>
        </div>
				<div class="box-body">
					<table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
						<thead style="background-color: #00c0ef;color: #fff;">
    						<tr>
    							<th class="col-md-4">區域名稱</th>
    							<th class="col-md-2">點讚數</th>
                  <th class="col-md-2">閱覽數</th>
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
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['like_count'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['read_count'];?>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">裝置</h3>
        </div>
        <div class="box-body">
          <table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-md-4">裝置名稱</th>
                  <th class="col-md-2">隸屬展項編號</th>
                  <th class="col-md-2">閱覽數</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['deviceData']->value;
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
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['device_id'];?>
&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['mode'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['read_count'];?>
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
