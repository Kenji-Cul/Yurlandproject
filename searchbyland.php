<?php 
include_once "projectlog.php";
$user = new User;

if($_GET['user'] == "superadmin"){
    $land = $user->searchByLand($_POST['searchproduct2'],$_GET['user'],$_GET['unique']);
   
}

if(isset($_GET['mode'])){
    $land = $user->downloadByLand($_POST['searchproduct2'],$_GET['user'],$_GET['unique']);
   
}

if($_GET['user'] == "subadmin"){
    $land = $user->searchByLand($_POST['searchproduct2'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
    $land = $user->searchAgentLand($_POST['searchproduct2'],$_GET['user'],$_GET['unique']);
}

if($_GET['user'] == "documentuser"){
    $type = "offer";
    $land = $user->searchLandDocument($_POST['searchproduct2'],$_GET['user'],$_GET['unique'],$type);
}

if($_GET['user'] == "allocationuser"){
    $type = "allocation";
    $land = $user->searchLandDocument($_POST['searchproduct2'],$_GET['user'],$_GET['unique'],$type);
}