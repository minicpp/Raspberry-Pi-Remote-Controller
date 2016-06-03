<?php

$exestr = 'sh gpio4light.sh 0 0 > /dev/null 2>&1 &';
exec($exestr);

header('Location: finish.html');
die();
?>
