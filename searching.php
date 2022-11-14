<?php 
include "projectlog.php";

$user = new User;
$search = $user ->searchProduct($_POST['searchproduct']);