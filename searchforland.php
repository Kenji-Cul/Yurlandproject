<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchLand($_POST['searchproduct']);