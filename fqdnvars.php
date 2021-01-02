<?php
// See gethomeip.sh and gethomeip.php for details
define('FQDNHOST', 'your.fqdn-hostnamehere.com');
// Typically the next line would be edited to suit
// your particular platform. Leave 'FQDNFILE' as is,
// but edit the path as necessary. This includes the
// str_replace(...) portion but for now it uses the 
// value of FQDNHOST and converts all file name 
// separators ('.') with underscores ('_'). Using the
// example, 'your.fqdn-hostnamehere.com' becomes 
// 'your_fqdn-hostnamehere_com'.
define('FQDNFILE', '/home/'.get_current_user().'/public_html/data/'.str_replace('.','_',FQDNHOST).'.json');
?>