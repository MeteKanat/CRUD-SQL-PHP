<?php
// başlatma
session_start();
 
// oturum değişkenlerini geri alma
$_SESSION = array();
 
// oturum yoketme
session_destroy();
 
// giriş sayfası yönlendrime
header("location: login.php");
exit;
?>
