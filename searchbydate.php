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

if($_GET['user'] == "documentuser"){
    $type = "offer";
    $land = $user->searchDocumentDate($_GET['data'],$_GET['user'],$_GET['unique'],$type);
}

if($_GET['user'] == "allocationuser"){
    $type = "allocation";
    $land = $user->searchDocumentDate($_GET['data'],$_GET['user'],$_GET['unique'],$type);
}

if($_GET['user'] == "subadmin2" || $_GET['user'] == "supadmin2" || $_GET['user'] == "agent2"){
    $land = $user->searchByDate2($_GET['data'],$_GET['user'],$_GET['unique'],$_GET['userid']);
}