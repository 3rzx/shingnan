<?php
$filename = "byteeeeeee.jpg";
$file = fopen($filename, "rb");
$contents = fread($file, filesize($filename));

//echo $contents;

$file2 = fopen("test.png","w"); //開啟檔案
fwrite($file2,$contents);
fclose($file2);

fclose($file);
?>