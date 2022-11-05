<?php 
include_once "projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['agentname'];
    $agent_password = $_POST['password'];
$referralid = $_POST['refid'];
$earningpercent = $_POST['percent'];

if(empty($name) || empty($referralid) || empty($earningpercent) || empty($agent_password)){
    $errormsg = "Please input all fields";
} else {
     $agent = new User;
     $insertagent = $agent->createAgent(check_input($name),check_input($agent_password),check_input($referralid),check_input($earningpercent));

}

if(isset($errormsg)){
    echo $errormsg;
}
}

function check_input($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>