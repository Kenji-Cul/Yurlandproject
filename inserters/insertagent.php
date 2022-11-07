<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['agentname'];
    $agentemail = $_POST['agentemail'];
    $agent_password = $_POST['password'];
$referralid = $_POST['refid'];
$earningpercent = $_POST['percent'];

if(empty($name) || empty($referralid) || empty($earningpercent) || empty($agent_password) || empty($agentemail)){
    $errormsg = "Please input all fields";
}

else {
     $agent = new User;
     $checkagent = $agent->checkAgentEmailAddress($agentemail);
     if(!empty($checkagent)){
        $errormsg = "Email Address already exists";
        }else{
     $insertagent = $agent->createAgent(check_input($name),check_input($agent_password),check_input($referralid),check_input($earningpercent), check_input($agentemail));
        }

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