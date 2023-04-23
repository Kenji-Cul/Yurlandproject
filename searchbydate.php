<?php 
include_once "projectlog.php";
$user = new User;

if($_GET['user'] == "superadmin"){
    $land = $user->searchByDate($_GET['data'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "subadmin"){
    $land = $user->searchByDate($_GET['data'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
    $land = $user->searchAgentDate($_GET['data'],$_GET['user'],$_GET['unique']);
}