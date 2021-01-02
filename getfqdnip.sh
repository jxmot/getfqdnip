#!/bin/sh
# This script is part of a utility, which contains:
#
#   getfqdnip.sh (this script file)
#   getfqdnip.php
#   readfqdndata.php
#   fqdndata.php
#
# Its purpose is to obtain the IP address and save it in 
# a JSON file by calling getfqdnip.php
#
# This command should be run as a CRON job at an interval 
# of once per day.
/usr/local/bin/php /home/$USER/public_html/data/getfqdnip.php
