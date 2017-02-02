Data Quality Web Services PHP5 Sample Code.


Prerequisite
====================

1.) The PHP Sample requires that you have a Web Server ie: APACHE or IIS. (Apache requires PHP mod enabled)

2.) Make sure you have installed PHP 5 or higher.

3.) The following PHP packages are required in order for PHP SOAP Sample to run:

PHP CURL - php_curl.dll


Notice:

In order to make sure that you have the appropriate packages installed, run the folowing PHP Script:

<?php
  phpinfo();
?> 

Search for the following values:

curl
curlsupport => enabled
If this information is not available in the phpinfo Page, this means that the required packages 
were not installed correctly. Please refer to the PHP website on how to propery install packages.


PHP Sample
========================
This sample has been tested using PHP 5.3.1 with PHP_CURL Package.
In order to run the sample client, you will need a Customer ID. To gain
access to a Demo Customer ID, please call our Melissa Data Sales Department
at 800-MELISSA ext. 3 (800-800-6245 ext. 3).


Running the Sample
========================

1.) Extract the sample zip file into a virtual directory of your webserver.

2.) Host the extraced files in your webserver.

3.) Browse the URL for MainForm.php ie: http://localhost/PropertyWS_XML_PHP_Win/MainForm.php  

4.) Input your Customer ID on the CustomerID Field and input the address you wish to verify before clicking the
    Verify button.

5.) Output would be saved in root directry as xml file. 


COPYRIGHT NOTICE
================
(C) 2009 Melissa Data Corporation. All rights reserved.

Address Object is a trademark and 1-800-800-MAIL is a registered trademark
of Melissa Data Corporation. UNIX is a registered trademark of The Open
Group. Linux is a registered trademark of Linus Torvalds.  Solaris is
a trademark of Sun Microsystems. Windows is a registered trademark of
Microsoft Corporation.

All other brands and products are trademarks of their respective
holder(s).



