<?php
/* Smarty version 3.1.28, created on 2017-09-04 15:28:17
  from "/var/www/html/web/view/mode/modeEdit.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_59ad00917a2f96_13439446',
  'file_dependency' => 
  array (
    'a2e582a5281402e82c27022b270f0e59c81a6fea' => 
    array (
      0 => '/var/www/html/web/view/mode/modeEdit.html',
      1 => 1480162391,
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
function content_59ad00917a2f96_13439446 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 
    <?php echo '<script'; ?>
 type="text/javascript" src="../javascript/modeEdit.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" src="../plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"><?php echo '</script'; ?>
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
                <h1>修改展項</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-8">
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
                        <div class="box box-success">
                             <div class="box-header with-border">
                                <h3 class="box-title">展項編號:&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
</h3>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="../controller/modeController.php" onsubmit="return formValidation();">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeName" name="modeName" value="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['name'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文名稱</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeNameEn" name="modeNameEn" value="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['name_en'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeIntroduction" name="modeIntroduction" value="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['introduction'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">英文簡介</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeIntroductionEn" name="modeIntroductionEn" value="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['introduction_en'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">語音導覽</label>
                                        <div class="col-sm-10">
                                             <input type="file" id="modeGuideVoice" name="modeGuideVoice" data-input="false" accept="audio/*">
                                            <audio controls id="modeGuideVoiceAudio" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['guide_voice'];?>
">
                                            </audio> 
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-2 control-label">英文語音導覽</label>
                                        <div class="col-sm-10">
                                             <input type="file" id="modeGuideVoiceEn" name="modeGuideVoiceEn" data-input="false" accept="audio/*">
                                            <audio controls id="modeGuideVoiceEnAudio" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['guide_voice_en'];?>
">
                                            </audio> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">影片</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="modeVideo" name="modeVideo" placeholder="輸入影片網址"><br>
                                            <iframe id="ytplayer" type="text/html" width="500" height="300"src="http://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['modeVideo']->value;?>
?autoplay=0&origin=http://example.com"frameborder="0"></iframe>
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(背景)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBG" name="modeBG" data-input="false" accept="image/*">
                                            <img id="modeBGImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_bg'];?>
">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(背景)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBGVertical" name="modeBGVertical" data-input="false" accept="image/*">
                                            <img id="modeBGVerticalImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_bg_vertical'];?>
">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(強調高亮)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeFG" name="modeFG" data-input="false" accept="image/*">
                                            <img id="modeFGImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_fg'];?>
">
                                        </div>
                                    </div>
                                    <div  class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(強調高亮)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeFGVertical" name="modeFGVertical" data-input="false" accept="image/*">
                                            <img id="modeFGVerticalImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_fg_vertical'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">過場圖片(模糊)</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="modeBL" name="modeBL" data-input="false" accept="image/*">
                                            <img id="modeBLImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_blur'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">直式過場圖片(模糊)</label>
                                        <div class="col-sm-10">
                                           <input type="file" id="modeBLVertical" name="modeBLVertical" data-input="false" accept="image/*">
                                            <img id="modeBLVerticalImg" class="img-thumbnail" src="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['splash_blur_vertical'];?>
">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">所屬區域</label>
                                        <div class="col-sm-4">
                                            <select id="modeZone" name="modeZone" class="selectpicker col-sm-10">
                                            <option value=""></option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['allZoneData']->value;
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
                                                <?php if ($_smarty_tpl->tpl_vars['item']->value['zone_id'] == $_smarty_tpl->tpl_vars['modeData']->value['zone_id']) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
" selected> <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php } else { ?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
" > <?php echo $_smarty_tpl->tpl_vars['item']->value['zone_id'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
                                                <?php }?>
                                            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
                                        </select>
                                        </div>
                                    </div>                   
                                </div>
                                <div class="box-footer" style="text-align: right;">
                                    <a href="../controller/modeController.php?action=detailMode&modeID=<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
" class="btn btn-warning">取消</a>
                                    <input type="hidden" name="action" value="updateMode">
                                    <input type="hidden" name="modeID" value="<?php echo $_smarty_tpl->tpl_vars['modeData']->value['mode_id'];?>
">
                                    <button type="submit" class="btn btn-primary">確定</button>
                                </div>
                            </form>
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
