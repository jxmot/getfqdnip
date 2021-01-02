# Get the IP of a FQDN

This is a simple utility that is used for obtaining the IP address of a FQDN(*fully qualified domain name*). There is a *shell script* file that can be run as a CRON job.

## Use Case

Let's say you have a PHP script that requires the IP address of a *known* host. One scenario might be an API endpoint written in PHP that needs the IP address of a specific host that is known to it. For reasons not necessary to discuss here that endpoint will only work with an IP address and *not* a FQDN.

## The Problem

One solution for our use case might be to resolve the FQDN *every time the endpoint is called*. In order to obtain the IP address we're interested in we'll call the PHP function `gethostbyname()`.

Overall the would be calling `gethostbyname()` every time we needed the IP address. And it's possible that `gethostbyname()` could take longer than expected and affect the performance of our application.

## The Solution

Is to utilize a CRON to run and call our utility. The `getfqdnip.sh` file is the command we will give to CRON.

## Set Up


### CRON


### Expected Output

## Reading the Results


