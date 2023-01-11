<?php 
include_once "projectlog.php";
$user = new User;
//$paymentdate = date($_POST['searchproduct2']);
if($_GET['user'] == "agent"){
$earning = $user->selectEarningbyDate($_GET['data']);
}

if($_GET['user'] == "customer"){
    $earning = $user->selectUserEarningbyDate($_GET['data']);
    }