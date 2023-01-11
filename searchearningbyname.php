<?php 
include_once "projectlog.php";
$user = new User;
if($_GET['user'] == "agent"){
    $earning = $user->selectEarningbyname($_POST['searchproduct']);
}

if($_GET['user'] == "customer"){
    $earning = $user->selectUserEarningbyname($_POST['searchproduct']);
}