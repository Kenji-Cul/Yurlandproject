<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchForCustomer($_POST['searchproduct'],$_GET['ref']);