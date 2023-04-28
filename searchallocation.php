<?php 
include "projectlog.php";
session_start();
$user = new User;
if($_GET['user'] == "supadmin"){
    $search = $user->searchAllocation($_POST['searchproduct']);
}

if($_GET['user'] == "superadmin"){
    $search = $user->searchPaying($_POST['searchproduct']);
}