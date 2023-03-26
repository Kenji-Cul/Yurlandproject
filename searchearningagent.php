<?php 
include "projectlog.php";
session_start();
$user = new User;
if($_GET['user'] == "supadmin"){
    $search = $user->searchEarningAgent($_POST['searchproduct']);
}