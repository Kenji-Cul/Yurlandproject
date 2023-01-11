<?php 
include_once "projectlog.php";
$user = new User;
if($_GET['user'] == "agent"){
$lastdays = date('M-d-Y', strtotime('today - '.$_GET['data'].' days'));
$earning = $user->selectEarningbyDate($lastdays);
}

if($_GET['user'] == "customer"){
    $lastdays = date('M-d-Y', strtotime('today - '.$_GET['data'].' days'));
    $earning = $user->selectUserEarningbyDate($lastdays);
    }