<?php
session_start();
$_SESSION['layer'] = $_POST['layer'];
$dates = array();
$_SESSION['sdate'] = $_POST['sDate'];
$_SESSION['edate'] = $_POST['eDate'];
$_SESSION['sDateToDisplay'] = $_POST['sDateToDisplay'];
$_SESSION['eDateToDisplay'] = $_POST['eDateToDisplay'];
echo $_SESSION['sdate'].','.$_SESSION['edate'].','.$_SESSION['sDateToDisplay'].','.$_SESSION['eDateToDisplay'];
?>