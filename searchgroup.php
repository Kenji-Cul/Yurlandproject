<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchGroup($_POST['searchproduct']);