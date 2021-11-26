<?php
session_start();

$_SESSION['username']='';
$_SESSION['status']='';
$_SESSION['namaAdmin']='';

unset($_SESSION['username']);
unset($_SESSION['status']);
unset($_SESSION['namaAdmin']);

session_unset();
session_destroy();
header('Location:login.php');

?>