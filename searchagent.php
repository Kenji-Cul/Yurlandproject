<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchAgent($_POST['searchproduct']);