<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchProduct($_POST['searchproduct']);