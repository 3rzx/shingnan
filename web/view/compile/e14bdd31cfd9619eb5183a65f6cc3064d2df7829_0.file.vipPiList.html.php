<?php
/* Smarty version 3.1.28, created on 2016-12-19 16:47:54
  from "/var/www/html/web/view/vipDevice/vipPiList.html" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.28',
  'unifunc' => 'content_58579ebaca5b99_80135051',
  'file_dependency' => 
  array (
    'e14bdd31cfd9619eb5183a65f6cc3064d2df7829' => 
    array (
      0 => '/var/www/html/web/view/vipDevice/vipPiList.html',
      1 => 1481103658,
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
function content_58579ebaca5b99_80135051 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
    <?php $_smarty_tpl->smarty->ext->_subtemplate->render($_smarty_tpl, "file:../common/resource.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php echo '<script'; ?>
 type="text/javascript">
        var voices = [];
        var devices = [];
        $(document).ready(function(){
            initVoice();
            initDevice();
        });
        // initial voice data
        function initVoice(){
            <?php
$_from = $_smarty_tpl->tpl_vars['vipVoiceData']->value;
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
                voices.push(<?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
);
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_local_item;
}
}
if ($__foreach_item_0_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_0_saved_item;
}
?>
        }
        // initial device data
        function initDevice(){
            <?php
$_from = $_smarty_tpl->tpl_vars['devices']->value;
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
                devices.push(<?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
);
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_local_item;
}
}
if ($__foreach_item_1_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_1_saved_item;
}
?>
        }
        function renderSelect(data, type, piId){
            var str = '';
            if(type == "voice"){
                str += '<select id="voiceSel' + piId + '" name="v_name" class="selectpicker col-sm-3" onchange="changeVoice(' + piId + ')">';
                data.forEach(function(item, index){
                    str += '<option value="' + item.voice + '">' + item.voice_name + '</option>'
                });
            }else if(type == "device"){
                str += '<select id="deviceSel' + piId + '" name="hu_id" class="selectpicker col-sm-3">';
                data.forEach(function(item, index){
                    str += '<option value="' + item.mac_addr + '">' + item.hu_id + '</option>'
                });
            }
            str += '</select>';

            return str;
        }

        function changeVoice(piId){
            $('#audio' + piId).attr('src', $('#voiceSel' + piId).val());
        }
        // scan vipDevice
        function scan() {
            // 送scan請求給server
            var url = '../scanPi.php';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var res = xmlhttp.responseText;
                    // alert(res);
                }
            }
            xmlhttp.send();

            var temp = BootstrapDialog.show({
                type: 'type-default',
                title: '掃描裝置中(等待15s)...',
                closable: false,
                message: '<div class="progress"><div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div>'
            });
            var i = 0;
            var counterBack = setInterval(function() {
                i++;
                if (i <= 15) {
                    $('.progress-bar').css('width', i * (100 / 15) + '%');
                } else {
                    clearInterval(counterBack);
                    temp.close();
                    location = "../controller/vipDeviceController.php?action=viewVIPPiList";
                }

            }, 1000);
        }
        // show device info
        function showInfo(piId, ip) {
            var str = '<h4>語音裝置資料</h4><table class="table table-striped">';
            str += '<thead><tr style="color:#FFFFFF;background-color: #00c0ef; width: 100%;"><th>裝置IP</th><th>裝置MAC</th><th>裝置狀態</th><th>建立時間</th><th>最後編輯</th></thead><tbody>';

            var visible = -1;
            <?php
$_from = $_smarty_tpl->tpl_vars['piData']->value;
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
                if(ip == '<?php echo $_smarty_tpl->tpl_vars['item']->value['IPaddress'];?>
'){
                    visible = <?php echo $_smarty_tpl->tpl_vars['item']->value['visible'];?>
;
                    str += '<tr><td><?php echo $_smarty_tpl->tpl_vars['item']->value['IPaddress'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['introduction'];?>
</td>';
                    if (visible == 1) {
                        str += '<td class="text-success">已發現</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td></tr>';
                    } else {
                        str += '<td class="text-danger">未發現</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['create_date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['lastupdate_date'];?>
</td></tr>';
                    }
                }
            <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_local_item;
}
}
if ($__foreach_item_2_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_2_saved_item;
}
?>
            str += '</tbody></table>';

            if(visible){
                var sel1 = renderSelect(devices, 'device', piId);
                var sel2 = renderSelect(voices, 'voice', piId);
                var arr = <?php echo json_encode($_smarty_tpl->tpl_vars['beacons']->value);?>
;
                var piArr = getPi(arr, ip);
                str += '<div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">語音檔(Server)</h3></div><form class="form-horizontal" method="post" action="" onsubmit="return formValidation();"><div class="box-body">';
                str += '<div class="form-group"><label for="hu_id" class="col-sm-2 control-label">貴賓證編號</label>';
                str += sel1;
                str += '</div><div class="form-group"><label for="v_name" class="col-sm-2 control-label">語音名稱</label>';
                str += sel2;
                str += '<br><audio class="col-sm-offset-2" id="audio' + piId + '" controls src="' + voices[0].voice + '"></audio></div>';
                str += '<div class="form-group"><label for="status" class="col-sm-2 control-label">同步狀態</label>';
                if(inPi(piArr, devices[0].mac_addr)){
                    str += '<div class="col-sm-2"><h5 class="text-success col-sm-2">已同步</h5></div>';
                }else{
                    if(visible){
                        str += '<button id="btnSyn"' + piId + ' class="btn btn-danger" onclick="synchronous(\'' + ip + '\',' + piId + ',3)">未同步</button>';
                    }else{
                        str += '<div class="col-sm-2"><h5 class="text-warning">未知</h5></div>';
                    }
                }
                str += '</div></form>';

                str += '<h4>語音檔(語音裝置)</h4><table class="table table-striped">';
                str += '<thead><tr style="color:#FFFFFF; background-color: #00c0ef; width: 100%;"><th>貴賓證MAC</th><th>語音檔</th><th>RSSI</th><th>最後編輯</th><th>操作</th></thead><tbody>';
                <?php
$_from = $_smarty_tpl->tpl_vars['beacons']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_beacon_3_saved_item = isset($_smarty_tpl->tpl_vars['beacon']) ? $_smarty_tpl->tpl_vars['beacon'] : false;
$__foreach_beacon_3_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['beacon'] = new Smarty_Variable();
$__foreach_beacon_3_total = $_smarty_tpl->smarty->ext->_foreach->count($_from);
if ($__foreach_beacon_3_total) {
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['beacon']->value) {
$__foreach_beacon_3_saved_local_item = $_smarty_tpl->tpl_vars['beacon'];
?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['beacon']->value;
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
                    if(same('<?php echo $_smarty_tpl->tpl_vars['item']->value['ip'];?>
', ip)){
                        str += '<tr><td><?php echo $_smarty_tpl->tpl_vars['item']->value['MAC'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['MUSIC'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['RSSI'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['item']->value['DATE'];?>
</td><td><button class="btn btn-sm btn-primary" onclick="synchronous(\'' + ip + '\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MAC'];?>
\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MUSIC'];?>
\',1);"><i class="glyphicon glyphicon-play"></i></button>&nbsp;<button class="btn btn-sm btn-warning" onclick="synchronous(\'' + ip + '\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MAC'];?>
\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MUSIC'];?>
\',2);"><i class="glyphicon glyphicon-pause"></i></button>&nbsp;<button class="btn btn-sm btn-danger" onclick="synchronous(\'' + ip + '\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MAC'];?>
\',\'<?php echo $_smarty_tpl->tpl_vars['item']->value['MUSIC'];?>
\',4);"><i class="glyphicon glyphicon-remove"></i></button></td></tr>';
                    }
                    <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_4_saved_local_item;
}
}
if ($__foreach_item_4_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_4_saved_item;
}
?>
                <?php
$_smarty_tpl->tpl_vars['beacon'] = $__foreach_beacon_3_saved_local_item;
}
}
if ($__foreach_beacon_3_saved_item) {
$_smarty_tpl->tpl_vars['beacon'] = $__foreach_beacon_3_saved_item;
}
if ($__foreach_beacon_3_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_beacon_3_saved_key;
}
?>
                str += '</tbody></table>';

                $('#panel' + piId).html(str);
                $('#voiceSel' + piId).selectpicker('refresh');
                $('#deviceSel' + piId).selectpicker('refresh');
            }else{
                $('#panel' + piId).html(str);
            }
        }

        function getPi(arr, ip){
            for(var i = 0; i < arr.length; i++){
                if(arr[i].length != 0 && arr[i][0].ip == ip){
                    return arr[i];
                }
            }
            return arr[0];
        }

        function inPi(devices, mac){
            for(var i = 0; i < devices.length; i++){
                if(devices[i].MAC == mac){
                    return true;
                }
            }
            return false;
        }

        function same(ip1, ip2){
            return (ip1 == ip2);
        }
        // synchronous voice data
        function synchronous(ip, piId, action){
            // 送scan請求給server
            var mac = $('#deviceSel' + piId).val();
            var music = $('#voiceSel' + piId).val();
            var url = '../synchronousPiDevice.php?ip=' + ip + '&mac=' + mac + '&music=' + music + '&action=' + action +'&rssi=190';
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", url, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var res = xmlhttp.responseText;
                    BootstrapDialog.alert(res);
                    if(action == 3){
                        location = '../controller/vipDeviceController.php?action=viewVIPPiList';
                    }
                }
            }
            xmlhttp.send();
        }
        // delete Pi from database
        function deleteDevice(ip){
            // 送scan請求給server
            BootstrapDialog.show({
                title:'提醒',
                message: '確定刪除語音裝置嗎?',
                buttons: [{
                    label: '確定',
                    cssClass: 'btn-danger',
                    action: function(){
                        location = '../controller/vipDeviceController.php?action=deletePiDevice&ip=' + ip;
                    }
                },{
                    label: '取消',
                    action: function(dialogItself){
                        dialogItself.close();
                    }
                }]
            });
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
                        <?php }?> <?php if ($_smarty_tpl->tpl_vars['msg']->value != '') {?>
                        <div class="alert alert-success alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4 style="display: inline;"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</h4>
                        </div>
                        <?php }?>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" onclick="scan();"><i class="fa fa-fw fa-spinner"></i>&nbsp;掃描裝置</button>
                        </div>
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">語音裝置列表</h3>
                            </div>
                            <div id="piList" class="box-body">
                                <?php
$_from = $_smarty_tpl->tpl_vars['piData']->value;
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
                                <div class="panel panel-default">
                                    <a>
                                        <div class="panel-heading" data-toggle="collapse" data-parent="#piList" data-target="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>
" onclick="showInfo(<?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['item']->value['IPaddress'];?>
');" href="#collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>
">
                                            <h4>
                                                <b>
                                                    語音裝置 ID: <?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>

                                                    <?php if ($_smarty_tpl->tpl_vars['item']->value['visible']) {?>
                                                    <span class="text-danger">&nbsp;(上線)</span>
                                                    <button class="btn btn-sm btn-primary" onclick="deleteDevice('<?php echo $_smarty_tpl->tpl_vars['item']->value['IPaddress'];?>
');"><i class="glyphicon glyphicon-minus"></i></button>
                                                    <?php } else { ?>
                                                    <span class="text-success">&nbsp;(離線)</span>
                                                    <?php }?>
                                                </b>
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne<?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>
" class="panel-collapse collapse">
                                    <div class="panel-body" id="panel<?php echo $_smarty_tpl->tpl_vars['item']->value['vip_pi_id'];?>
">
                                    </div>
                                </div>
                                <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_5_saved_local_item;
}
}
if ($__foreach_item_5_saved_item) {
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_5_saved_item;
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
