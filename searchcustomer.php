<?php 
include "projectlog.php";
session_start();
$user = new User;


if($_GET['user'] == "agenttotal"){
    $search = $user->searchCustomerEarning($_POST['searchproduct']);
} else {
    $search = $user ->searchCustomer($_POST['searchproduct']);
}