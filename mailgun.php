<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-61a88fe0b8aa0e63320efcde642c9253');
$domain = "app.maptrackpro.com";

# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Vikash Bhartia <vick@maptrackpro.com>',
    'to'      => 'Vikash <vb.net20010@gmail.com>',
    'subject' => 'Hello',
    'text'    => 'Testing some Mailgun awesomness!'
));

?>