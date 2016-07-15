<?php
session_start();
session_destroy();
setcookie("username", $username, time()-7600, "/");
header("location:index.php");
?>
