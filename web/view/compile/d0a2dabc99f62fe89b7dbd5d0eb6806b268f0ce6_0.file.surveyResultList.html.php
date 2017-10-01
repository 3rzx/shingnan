<?php
/* Smarty version 3.1.28, created on 2017-02-08 16:21:59
  from "/var/www/html/web/view/statistic/surveyResultList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_589ad5279c8e99_05886129',
  'file_dependency' => 
  array (
    'd0a2dabc99f62fe89b7dbd5d0eb6806b268f0ce6' => 
    array (
      0 => '/var/www/html/web/view/statistic/surveyResultList.html',
      1 => 1486542041,
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
function content_589ad5279c8e99_05886129 ($_smarty_tpl) {
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
            <h1>問卷調查統計</h1>
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
          <input type="hidden" name="action" value="viewSurveyResultDate">
        </div>
        <div class="box-body"  style="text-align: right;">
          <button class="btn btn-primary" type="submit">確定</button>
        </div>
      </form>
  </div>
  </div>    
  </div> 
	<div class="row">
		<div class="col-sm-6">
			<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">性別</h3>
        </div>
				<div class="box-body">
					<table id="surveyGenderTable" class="table table-striped" cellspacing="0" width="100%">
						<thead style="background-color: #00c0ef;color: #fff;">
    						<tr>
    							<th class="col-sm-6">選項</th>
    							<th>統計</th>
    						</tr>
						</thead>
						<tbody>
                <tr>
                  <td>男</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[0][1];?>
</td>
                </tr>
                <tr>
                  <td>女</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[0][2];?>
</td>
                </tr>
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
            <thead style="background-color: #00c0ef;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td >20歲以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][1];?>
</td>
                </tr>                
                <tr>
                  <td>20-25歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][2];?>
</td>
                </tr>              
                <tr>
                  <td>26-30歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][3];?>
</td>
                </tr>
                <tr>
                  <td>31-40歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][4];?>
</td>
                <tr>               
                <tr>
                  <td>41-50歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][5];?>
</td>
                </tr>               
                <tr>
                  <td>51-59歲</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][6];?>
</td>
                </tr>               
                <tr>
                  <td>60歲以上</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[1][7];?>
</td>
                </tr>               
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
            <thead style="background-color: #00c0ef;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>             
                <tr>
                  <td>高中以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[2][4];?>
</td>
                </tr>
                <tr>
                  <td>專科</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[2][2];?>
</td>
                </tr>
                <tr>
                  <td>大學</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[2][1];?>
</td>
                </tr>
                <tr>
                  <td>研究所(含)以上</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[2][3];?>
</td>
                </tr>
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
            <thead style="background-color: #00c0ef;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td>學生</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][1];?>
</td>
                </tr>
                <tr>
                  <td>公務人員</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][2];?>
</td>
                </tr>
                <tr>
                  <td>教育服務業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][3];?>
</td>
                </tr>
                <tr>
                  <td>營造建築業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][4];?>
</td>
                </tr>
                 <tr>
                  <td>電子業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][5];?>
</td>
                </tr>
                <tr>
                  <td>不定產業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][6];?>
</td>
                </tr>
                <tr>
                  <td>資訊通訊傳播</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][7];?>
</td>
                </tr>
                <tr>
                  <td>金融保險業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][8];?>
</td>
                </tr>
                <tr>
                  <td>制造業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][9];?>
</td>
                </tr>
                <tr>
                  <td>家管</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][10];?>
</td>
                </tr>
                <tr>
                  <td>服務業</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][11];?>
</td>
                </tr>
                <tr>
                  <td>其他</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[3][12];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">從事之行業工作與智慧化產品開發有關之經歷</h3>
        </div>
        <div class="box-body">
          <table id="surveyExprenceTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;" >
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>             
                <tr>
                  <td>無</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][1];?>
</td>
                </tr>
                <tr>
                  <td>1年以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][2];?>
</td>
                </tr>
                <tr>
                  <td>1-3年</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][3];?>
</td>
                </tr>
                <tr>
                  <td>3-5年</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][4];?>
</td>
                </tr>
                 <tr>
                  <td>5-10年</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][5];?>
</td>
                </tr>
                <tr>
                  <td>10年以上</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[7][6];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">月收入</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td>5千-1萬元</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][1];?>
</td>
                </tr>
                <tr>
                  <td>1萬1千-2萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][2];?>
</td>
                </tr>
                <tr>
                  <td>2萬1千-3萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][3];?>
</td>
                </tr>
                <tr>
                  <td>3萬1千-4萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][4];?>
</td>
                </tr>
                <tr>
                  <td>4萬1千-5萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][5];?>
</td>
                </tr>
                <tr>
                  <td>5萬1千-6萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][6];?>
</td>
                </tr>
                <tr>
                  <td>6萬以上</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[8][7];?>
</td>
                </tr>
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
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td>台灣北部</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][1];?>
</td>
                </tr>
                <tr>
                  <td>台灣中部</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][2];?>
</td>
                </tr>
                <tr>
                  <td>台灣南部</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][3];?>
</td>
                </tr>
                <tr>
                  <td>台灣東部</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][4];?>
</td>
                </tr>
                <tr>
                  <td>離島地區</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][5];?>
</td>
                </tr>
                <tr>
                  <td>其他</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[4][6];?>
</td>
                </tr>
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
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td>公寓</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[5][1];?>
</td>
                </tr>
                <tr>
                  <td>集合式住宅</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[5][2];?>
</td>
                </tr>
                <tr>
                  <td>住商混合大樓</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[5][3];?>
</td>
                </tr>
                <tr>
                  <td>獨棟透天厝</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[5][4];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">家庭組織型態</h3>
        </div>
        <div class="box-body">
          <table id="surveyFamilyTypeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>              
                <tr>
                  <td>核心家庭(成員包含父母二人及至少一名子女之二代家庭)</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[6][4];?>
</td>
                </tr>
                <tr>
                  <td>單人家庭(獨自居住或與室友同住)</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[6][1];?>
</td>
                </tr>
                <tr>
                  <td>夫婦二人</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[6][2];?>
</td>
                </tr>
                <tr>
                  <td>單親家庭</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[6][3];?>
</td>
                </tr> 
                <tr>
                  <td>三代家庭</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[6][5];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">家庭中的特殊成員</h3>
        </div>
        <div class="box-body">
          <table id="surveyFamilyTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>無</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[9][1];?>
</td>
                </tr>
                <tr>
                  <td>有行動不便者</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[9][2];?>
</td>
                </tr>
                <tr>
                  <td>有65歲以上老人</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[9][3];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">何種管道得知導覽服務</h3>
        </div>
        <div class="box-body">
          <table id="surveyKnowTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>報章媒體</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][1];?>
</td>
                </tr>
                <tr>
                  <td>新聞媒體</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][2];?>
</td>
                </tr>
                <tr>
                  <td>網際網路</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][3];?>
</td>
                </tr>
                <tr>
                  <td>親友同事</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][4];?>
</td>
                </tr>
                <tr>
                  <td>學校機關</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][5];?>
</td>
                </tr>
                <tr>
                  <td>其他</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['surveyResult']->value[10][6];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">對智慧化科技產品的態度傾向</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>非常支持</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[0][1];?>
</td>
                </tr>
                <tr>
                  <td>支持</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[0][2];?>
</td>
                </tr>
                <tr>
                  <td>尚可</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[0][3];?>
</td>
                </tr>
                <tr>
                  <td>不支持</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[0][4];?>
</td>
                </tr>
                <tr>
                  <td>非常不支持</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[0][5];?>
</td>
                </tr>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">對智慧化科技產品購買與使用態度傾向，重要程度看法</h3>
        </div>
        <div class="box-body">
          <table id="surveyAttitudeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-6">選項</th>
                  <th>非常重要</th>
                  <th>重要</th>
                  <th>普通</th>
                  <th>不重要</th>
                  <th>非常不重要</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>功能性</td>             
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[1][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[1][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[1][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[1][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[1][5];?>
</td>
              </tr>
              <tr>
                <td>視覺美觀性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[2][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[2][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[2][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[2][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[2][5];?>
</td>
              </tr>
              <tr>
                <td>操作實用性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[3][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[3][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[3][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[3][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[3][5];?>
</td>
              </tr>
              <tr>
                <td>人性化設計性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[4][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[4][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[4][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[4][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[4][5];?>
</td>
              </tr>
              <tr>
                <td>價格性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[5][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[5][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[5][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[5][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[5][5];?>
</td>
              </tr>
              <tr>
                <td>維護與管理性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[6][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[6][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[6][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[6][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[6][5];?>
</td>
              </tr>
              <tr>
                <td>安全性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[7][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[7][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[7][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[7][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[7][5];?>
</td>
              </tr>
              <tr>
                <td>節能性</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[8][1];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[8][2];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[8][3];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[8][4];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[8][5];?>
</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">未來是否會購買相關智慧化系統或設備</h3>
        </div>
        <div class="box-body">
          <table id="survey2BuyTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>否</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[9][1];?>
</td>
                </tr>
                <tr>
                  <td>是</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[9][2];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">單項智慧化系統或設備的平均合理價格</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-6">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                  <td>1萬以下</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[10][1];?>
</td>
                </tr>
                <tr>
                  <td>1-5萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[10][2];?>
</td>
                </tr>
                <tr>
                  <td>5-10萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[10][3];?>
</td>
                </tr>
                <tr>
                  <td>10-20萬</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[10][4];?>
</td>
                </tr>
                <tr>
                  <td>20萬以上</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['survey2Result']->value[10][5];?>
</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">智慧化系統或設備的人氣排名前五名</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th class="col-sm-2">設備</th>
                  <th>功能良好</th>
                  <th>視覺美觀佳</th>
                  <th>實用操作性佳</th>
                  <th>人性化設計</th>
                  <th>易維護管理</th>
                  <th>安全特性</th>
                  <th>節能特性</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['survey2DeviceChooseData']->value;
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
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider1'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider2'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider3'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider4'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider5'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider6'];?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['item']->value['consider7'];?>
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
          <h3 class="box-title">期望安裝的系統或設備前五名</h3>
        </div>
        <div class="box-body">
          <table id="surveyIntallTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-4">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['survey2DeviceInstallData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_1_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_1_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_1_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_1_total) {
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_1_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
              <tr>
                <td>第<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
名</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
              </tr>
              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
if ($__foreach_item_1_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_item_1_saved_key;
}
?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">印象良好的系統或設備前五名</h3>
        </div>
        <div class="box-body">
          <table id="surveyIncomeTable" class="table table-striped" cellspacing="0" width="100%">
            <thead style="background-color: #00c0ef;color: #fff;">
                <tr>
                  <th  class="col-sm-4">選項</th>
                  <th>統計</th>
                </tr>
            </thead>
            <tbody>
              <?php
$_from = $_smarty_tpl->tpl_vars['survey2DeviceImpressionData']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_item_2_saved_item = isset($_smarty_tpl->tpl_vars['item']) ? $_smarty_tpl->tpl_vars['item'] : false;
$__foreach_item_2_saved_key = isset($_smarty_tpl->tpl_vars['k']) ? $_smarty_tpl->tpl_vars['k'] : false;
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable();
$__foreach_item_2_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_item_2_total) {
$_smarty_tpl->tpl_vars['k'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['item']->value) {
$__foreach_item_2_saved_local_item = $_smarty_tpl->tpl_vars['item'];
?>
              <tr>
                <td>第<?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
名</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</td>
              </tr>
              <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
if ($__foreach_item_2_saved_key) {
$_smarty_tpl->tpl_vars['k'] = $__foreach_item_2_saved_key;
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
