<?php
// gethomeip.php : Intended for use when a service like DynDNS
// is used for assigning a FQDN to a "home" IP address. And 
// that IP address is needed by an application that is external
// and not connected to the "home" network.

// INVESTIGATE! : This should work for Linux. But under Windows
// it's not clear. If ran under Windows it won't cause any 
// problems but it could be ineffective.
// 
// Options for the underlying resolver functions can be supplied 
// by using the RES_OPTIONS environmental variable. (at least 
// under Linux, see man resolv.conf)
// 
// Set timeout and retries to 1 to have a maximum execution time 
// of 1 second for the DNS lookup:
// 
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