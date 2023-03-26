<?php
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$user = new User;
$disableagent = $user->enableSubadmin($_POST['agentid2']);
echo "success";
}