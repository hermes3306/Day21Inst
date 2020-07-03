<html><body>
<?php include('common.php'); ?>
<?php include('menu.php'); ?>
<?php

$cont = file_get_contents($mbox_home . "/Day21.log"); 
echo nl2br($cont);

?>
</body>
</html>
