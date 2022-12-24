<?php 
session_start();
session_unset();
session_destroy();
header("Location: portallogin.php?msg=Successfully logged out");
?>