<?php
exec("java -jar scanPi.jar 127.0.0.1 tncb_new tncb tncbuser", $output, $rv);
echo var_export($output, true);
