<?php
putenv('RES_OPTIONS=retrans:1 retry:1 timeout:1 attempts:1');
require_once dirname(__FILE__).'/_fqdnvars.php';
$hostip = filter_var(gethostbyname(FQDNHOST), FILTER_VALIDATE_IP);

if($hostip !== false) {
    //echo $hostip;
    // overwrite any existing file
    $fileid = fopen(FQDNFILE,'w');
    fwrite($fileid, '{"hostip":"'.$hostip.'","hostname":"'.FQDNHOST.'"}');
    fflush($fileid);
    fclose($fileid);
}
exit(0);
?>