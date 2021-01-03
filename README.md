# Get the IP of a FQDN

This is a simple utility that is used for obtaining the IP address of a FQDN(*fully qualified domain name*). There is a *shell script* file that can be run as a CRON job.

## Use Case

Let's say you have a PHP script that requires the IP address of a *known* host. One scenario might be an API endpoint that needs an IP address. For reasons not necessary to discuss here that endpoint will only work with an IP address and *not* a FQDN.

## The Problem

One solution for our use case might be to resolve the FQDN *every time the endpoint is called*. In order to obtain the IP address we're interested in we'll call the PHP function `gethostbyname()`.

Overall the would be calling `gethostbyname()` every time we needed the IP address. And it's possible that `gethostbyname()` could take longer than expected and affect the performance of our application.

## The Solution

Is to utilize a CRON to run our utility. The `getfqdnip.sh` file is the command we will give to CRON.

## Set Up

The four primary files are:

* `getfqdnip.sh` - the shell script ran by CRON
* `fqdnvars.php` - used by `getfqdnip.php` and `readfqdndata.php`, it contains the host to look up, and the path+filename of the output JSON file
* `getfqdnip.php` - calls `gethostbyname()` to obtain the IP of the host and it writes the found IP to the JSON file.
* `readfqdndata.php` - intended to be used by an PHP application, it reads the JSON file and saves an object in the `$fqdndata` variable

There is also `indextest.php`. It can be requested by a browser, and it will display the host name and host IP.

### File Locations

You may have to create a folder in your documents root named `php`. For example, the new folder would be at `/home/$USER/public_html/php`. 

You may also have to create a folder in your documents root named `data`. This folder would be at `/home/$USER/public_html/data`.

The `public_html` portion of the path is your server's *document root* folder, and may be named differently for your server.

The `indextest.php` file can be placed anywhere in your document root.

**NOTE**: Where the files are placed depends on **your** platform, and how it's been set up. For example, if your running on a typical Linux hosting server with cPanel then it's likely that the paths and file locations will closely match the examples here.

### Editing

The first file you should look at is `getfqdnip.sh`:

```
#!/bin/sh
/usr/local/bin/php /home/$USER/public_html/php/getfqdnip.php
```

Depending on *where* you have placed the files on your server you may have to edit the `/home/$USER/public_html/php/getfqdnip.php` path.

Don't forget to make `getfqdnip.sh` *executable*. Use the following command:

**`chmod +x getfqdnip.sh`**


The next file to edit is `fqdnvars.php`:

```
<?php
// See gethomeip.sh and gethomeip.php for details
define('FQDNHOST', 'your.fqdn-hostnamehere.com');
define('FQDNFILE', '/home/'.get_current_user().'/public_html/data/'.str_replace('.','_',FQDNHOST).'.json');
?>
```

Typically the line below would be edited to suit your particular platform. Leave `'FQDNFILE'` as is, but edit the path as necessary. This includes the `str_replace(...)` portion but for now it uses the value of `'FQDNHOST'` and converts all file name separators ('.') with underscores ('_'). Using the example, `'your.fqdn-hostnamehere.com'` becomes `'your_fqdn-hostnamehere_com'`.

```
define('FQDNFILE', '/home/'.get_current_user().'/public_html/data/'.str_replace('.','_',FQDNHOST).'.json');
```

**NOTE**: the path in `getfqdnip.sh` and in `fqdnvars.php` do not have to be the same location. 

### CRON

I will assume that you already know how to setup a CRON job on your system. 

### Expected Output

Using the `'FQDNHOST'` example in `fqdnvars.php` a file named **`your_fqdn-hostnamehere_com.json`** should be located in the path specified by `FQDNFILE`. The file will contain:

```
{"hostip":"123.123.123.123","hostname":"your.fqdn-hostnamehere.com"}
```

## Reading the Results

The `readfqdndata.php` file can be used by your application to read the JSON file. When it's run an object variable named `$fqdndata` will be created. You can access that to get the IP and host:

```
echo $fqdndata->hostip ."\n";
echo $fqdndata->hostname ."\n";
```

### Example Usage

The `indextest.php` is provided for testing. It will retrieve the host information and display it in a bulleted list.

Here is the file:

```
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
```
---
<img src="http://webexperiment.info/extcounter/mdcount.php?id=getfqdnip">