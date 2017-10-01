<?php
/* Smarty version 3.1.28, created on 2016-09-07 18:47:40
  from "C:\xampp\htdocs\tabc_backend_new\web\view\statistic\surveyResultList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_57d044ac134872_81627423',
  'file_dependency' => 
  array (
    'cf05c89f87f708d8991d62cafa9515f1ef395dac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tabc_backend_new\\web\\view\\statistic\\surveyResultList.html',
      1 => 1473266848,
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
function content_57d044ac134872_81627423 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
  <head>
	<?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


    <!-- data table -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['homePath']->value;?>
theme/AdminLTE/plugins/datatables/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['homePath']->value;?>
theme/AdminLTE/plugins/datatables/jquery.dataTables.min.css">
    <!-- column order -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['homePath']->value;?>
theme/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['homePath']->value;?>
theme/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
    
	
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
            <h1>問卷調查統計</h1>
        </section>

        <!-- Main content -->
        <section class="content">
	<div class="row">
		<div class="col-xs-6">
			<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">性別</h3>
        </div>
				<div class="box-body">
					<table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
						<thead style="background-color: #3c8dbc;color: #fff;">
    						<tr>
    							<th class="col-sm-6">選項</th>
    							<th>統計</th>
    						</tr>
						</thead>
						<tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyGenderData']->value;
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
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>男</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>女</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
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
          <h3 class="box-title">年齡</h3>
        </div>
        <div class="box-body">
          <table id="surveyAgeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyAgeData']->value;
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
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td >15歲以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>16-20歲</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>21-25歲</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                 
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>26-30歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                <tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                <tr>
                  <td>31-40歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 6) {?>
                <tr>
                  <td>41-50歲</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 7) {?>
                <tr>
                  <td>51-60歲</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 8) {?>
                <tr>
                  <td>61-65歲</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 9) {?>
                <tr>
                  <td>66歲以上</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">教育程度</h3>
        </div>
        <div class="box-body">
          <table id="surveyEducationTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;" >
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyEducationData']->value;
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
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>高中以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>專科</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>大學</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>研究所(含)以上</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
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
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">職業</h3>
        </div>
        <div class="box-body">
          <table id="surveyCareerTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyCareerData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_3_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_3_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_3_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_3_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>學生</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>公職人員</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>教育服務業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>營造建築業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                 <tr>
                  <td>電子業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 6) {?>
                <tr>
                  <td>服務業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 7) {?>
                <tr>
                  <td>不動產業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 8) {?>
                <tr>
                  <td>資訊及通訊傳播業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 9) {?>
                <tr>
                  <td>金融及保險業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 10) {?>
                <tr>
                  <td>製造業</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 11) {?>
                <tr>
                  <td>管家</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 12) {?>
                <tr>
                  <td>其他</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_local_item;
}
}
if ($__foreach_item_3_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_3_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">居住地</h3>
        </div>
        <div class="box-body">
          <table id="surveyLocationTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyLocationData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_4_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_4_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_4_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_4_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>台灣北部</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>台灣中部</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>台灣南部</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>台灣東部</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>          
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                <tr>
                  <td>離島地區</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>               
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 6) {?>
                <tr>
                  <td>其他</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_4_saved_local_item;
}
}
if ($__foreach_item_4_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_4_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">房屋類型</h3>
        </div>
        <div class="box-body">
          <table id="surveyHouseTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyLocationData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_5_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_5_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_5_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_5_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>公寓</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>集合式住宅</td>
                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>住商混合大樓</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>獨棟透天厝</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                <tr>
                  <td>其他</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_5_saved_local_item;
}
}
if ($__foreach_item_5_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_5_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">家庭組織型態</h3>
        </div>
        <div class="box-body">
          <table id="surveyFamilyTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyFamilyData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_6_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_6_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_6_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_6_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>核心家庭(成員包含父母二人及至少一名子女之二代家庭)</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>單人家庭(獨自居住或與室友同住)</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>夫婦二人</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>單親家庭</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                <tr>
                  <td>三代家庭</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 6) {?>
                <tr>
                  <td>其他</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_6_saved_local_item;
}
}
if ($__foreach_item_6_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_6_saved_item;
}
?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">年收入</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #3c8dbc;color: #fff;">
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['surveyLocationData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_7_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_7_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_7_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_7_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 1) {?>
                <tr>
                  <td>30萬以下</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 2) {?>
                <tr>
                  <td>31-50萬</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                 
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 3) {?>
                <tr>
                  <td>51-80萬</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                  
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 4) {?>
                <tr>
                  <td>81-150萬</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>                 
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 5) {?>
                <tr>
                  <td>150萬以上</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['item']->value['answer'] == 6) {?>
                <tr>
                  <td>其他</td>                  
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>
</td>
                </tr>
                <?php }?>
                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_7_saved_local_item;
}
}
if ($__foreach_item_7_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_7_saved_item;
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
