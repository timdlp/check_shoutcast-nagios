# check_shoutcast-nagios
### Simple PHP script to monitor a shoutcast DNAS v1 stream with Nagios Core

## Introduction
I needed a way to check some old Shoutcast DNAS v1 streams with Nagios Core and found nothing working so I've searched the internet till I came up with this home made solution.

It's tested and intended to work with Nagios Core 4.3.4 but as it's PHP, you could run it anywhere.

### Requires the following PHP extensions
- [CURL](http://php.net/manual/en/curl.installation.php)
- [SimpleXML](http://php.net/manual/en/simplexml.installation.php)

### Usage
In order to run the file on CLI you need to make the file executable like this :

````bash
chmod +x check_shoutcast.php
````
Then just run it 
````bash
./check_shoutcast.php -H HOSTNAME -p PORT -u USER -P PASSWORD
````
