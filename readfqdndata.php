<?php
// readfqdnip.php : reads the JSON object saved in 
// the ?????.json file and saves it to a variable.
//
// Where: ????? is the file name that was constructed
// and saved in FQDNFILE
require_once dirname(__FILE__).'/fqdnvars.php';
$fqdndata = json_decode(file_get_contents(FQDNFILE));
?>