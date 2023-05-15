<?php 
include "projectlog.php";
session_start();
$user = new User;
if($_GET['user'] == "supadmin"){
    $search = $user->searchExecutive($_POST['searchproduct']);
}



if($_GET['user'] == "agenttotal"){
    $search = $user->searchExecutiveEarning($_POST['searchproduct']);
}