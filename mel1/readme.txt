Melissa Data Personator Web Service PHP5 Sample Code

======================
=    Prerequisite    =
======================

1) The PHP Sample requires that you have a web server ie: APACHE or IIS (Apache requires PHP mod enabled)
2) Make sure you have installed PHP 5 or higher
3) The following PHP packages are required in order for PHP SOAP Sample to run:

PHP SOAP - php_soap.dll
PHP OPENSSL - php_openssl.dll

Notice:
In order to make sure that you ahve the appropriate packages installed, run the following PHP Script:

<?php
phpinfo();
?>

Search for the following values:

openssl
OpenSSL support => enabled

soap
Soap Client => enabled

If this information is not available in the phpinfo Page, this means that the required packages were not installed correctly. Please refer to the PHP website on how to properly install packages.

======================
=    PHP Sample      =
======================
This sample has been tested using PHP 5.3.3 with PHP_SOAP and PHP_OPENSSL Packages.
In order to run the sample client, you will need a valid Customer ID. To gain access 
to a Demo Customer ID, please call our Melissa Data Sales Department at
800-MELISSA ext 3 (800-8006245 ext. 3).

======================
= Running the Sample =
======================
1) Extract the sample zip file into a virtual directory of your webserver.
2) Host the extracted files in your webserver.
3) Browse the URL for melissa_form.php ie:
http://localhost/dqwsPHP_SOAP_SAMPLE/md_Form.php

4) Input your Customer ID in the CustomerID Field and input an address you wish to verify
5) Click the verify button

======================
=  COPYRIGHT NOTICE  =
======================
(C) 2012 Melissa Data Corporation. All rights reserved.

International Web Service is a trademark and 1-800-800-MAIL is a registered trademark
of Melissa Data Corporation. UNIX is a registered trademark of The Open
Group. Linux is a registered trademark of Linus Torvalds.  Solaris is
a trademark of Sun Microsystems. Windows is a registered trademark of
Microsoft Corporation.

All other brands and products are trademarks of their respective
holder(s).