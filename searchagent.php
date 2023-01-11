<?php 
include "projectlog.php";
session_start();
$user = new User;
if($_GET['user'] == "subadmin"){
    $search = $user->searchAgent($_POST['searchproduct']);
}

if($_GET['user'] == "agenttotal"){
    $search = $user->searchAgentEarning($_POST['searchproduct']);
}