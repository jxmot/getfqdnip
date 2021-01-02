<?php
// See gethomeip.sh and gethomeip.php for details
define('FQDNHOST', 'your.fqdn-hostnamehere.com');
define('FQDNFILE', '/home/'.get_current_user().'/public_html/data/'.str_replace('.','_',FQDNHOST).'.json');
?>