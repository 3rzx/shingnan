<?php

$host="localhost";
$user="tncb";
$upwd="tncbuser"; // 123
$db="tncb_new";

$link=mysql_connect($host,$user,$upwd) or die ("Unable to connect!");
mysql_select_db($db, $link) or die ("Unable to select database!");

?>
