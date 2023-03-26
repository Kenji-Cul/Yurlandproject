<?php 
include "projectlog.php";
session_start();
$user = new User;
$search = $user ->searchLand2($_POST['searchproduct']);