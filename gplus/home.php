<!doctype html>
<html>
<title>Home - Login with Google Plus</title>
<body >
<div style="margin:0px auto; width:800px;text-align:left;font-family:arial">
<a href='http://9lessons.info'>9lessons.info</a> 

<h1>Home - Login with Google Plus</h1>
<?php
session_start();
if (!isset($_SESSION['gplusdata'])) {
    // Redirection to login page twitter or facebook
    header("location: index.php");
}
else
{
$me=$_SESSION['gplusdata'];
var_dump($me);
?>

<?php 
print "<a class='logout' href='index.php?logout'>Logout</a><br/> <br/> "; 
}
?>

</div>

</body>
</html>