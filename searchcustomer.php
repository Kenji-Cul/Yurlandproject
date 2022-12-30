<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchCustomer($_POST['searchproduct']);