<?php 
session_start();
session_unset();
session_destroy();
if(isset($_GET['user'])){
    if($_GET['user'] == "subadmin"){
        header("Location: teamspace.php?msg=Successfully logged out");
    }
} else {
    header("Location: login.php?msg=Successfully logged out");
}

?>