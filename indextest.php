<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/readfqdndata.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Test - readfqdndata.php</title>
  </head>
  <body>
    <p>
        <ul>
            <li>FQDNHOST = <?php echo FQDNHOST; ?></li>
            <li>FQDNFILE = <?php echo FQDNFILE; ?></li>
        </ul>
        <ul>
            <li>hostip = <?php echo $fqdndata->hostip; ?></li>
            <li>hostname = <?php echo $fqdndata->hostname; ?></li>
        </ul>
    </p>
  </body>
</html>
