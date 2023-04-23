<?php 
include_once "projectlog.php";
$user = new User;

if($_GET['user'] == "superadmin"){
    $land = $user->searchByPayer($_POST['searchproduct'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "subadmin"){
    $land = $user->searchByPayer($_POST['searchproduct'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "agent"){
    $land = $user->searchAgentPayer($_POST['searchproduct'],$_GET['user'],$_GET['unique']);
}