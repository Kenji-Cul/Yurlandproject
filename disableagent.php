<?php
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$user = new User;
$disableagent = $user->disableAgent($_POST['agentid']);
echo "success";
}