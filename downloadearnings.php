<?php
include_once "projectlog.php";
$user = new User;
if($_GET['user'] == "download"){
 
    if($_GET['dataone'] == "" || $_GET['datatwo'] == ""){
        echo "Please Fill Details";
    } else {
        $earning = $user->downloadAgentEarning($_GET['dataone'],$_GET['datatwo']);
         
    }

    if(isset($_POST['export'])){
       
    
    }
 
    }