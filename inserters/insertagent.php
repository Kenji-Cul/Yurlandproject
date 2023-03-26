<?php 
session_start();
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['agentname'];
    $agentemail = $_POST['agentemail'];
    $agent_password = $_POST['password'];
$referralid = $_POST['refid'];
$earningpercent = $_POST['percent'];
$groupid = $_GET['groupid'];

if(empty($name) || empty($referralid) || empty($earningpercent) || empty($agent_password) || empty($agentemail)){
    $errormsg = "Please input all fields";
}

else if (!filter_var($agentemail, FILTER_VALIDATE_EMAIL)) {
    $errormsg = "Invalid email format";
  }

else {
     $agent = new User;
     $checkagent = $agent->checkEmailAddress(check_input($agentemail));
     $checkagent2 = $agent->checkAgentEmailAddress(check_input($agentemail));
     $checkagent3 = $agent->checkExecutiveEmailAddress(check_input($agentemail));
     $checkagent4 = $agent->checkSubadminEmailAddress(check_input($agentemail));
     $checkagent5 = $agent->checkSuperadminEmailAddress(check_input($agentemail));
     if(!empty( $checkagent) || !empty( $checkagent2) || !empty( $checkagent3) || !empty( $checkagent4) || !empty( $checkagent5)){
     $errormsg = "Email Address already exists";
     }else{
        if(isset($_SESSION['uniquesubadmin_id'])){
            $creatorid = $_SESSION['uniquesubadmin_id'];
            }
        
            if(isset($_SESSION['uniquesupadmin_id'])){
            $creatorid = $_SESSION['uniquesupadmin_id'];
            }
     $insertagent = $agent->createAgent(check_input($name),check_input($agent_password),check_input($referralid),check_input($earningpercent), check_input($agentemail),$groupid,$creatorid);
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