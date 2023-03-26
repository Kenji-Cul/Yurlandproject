<?php
include_once "projectlog.php";
$user = new User;
if($_GET['user'] == "monthearn"){
    if($_POST['searchyear'] == "" || $_GET['data'] == ""){
        echo "Please Fill Details";
    } else {
        $earning = $user->searchExecutiveEarningByMonth($_GET['data'],$_POST['searchyear']);
    }
    
    }