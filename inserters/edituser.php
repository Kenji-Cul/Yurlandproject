<?php 
include_once "../projectlog.php";
//session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $nin = $_POST['nin'];
    $dob = $_POST['dob'];
    $unique = $_POST['uniqueuser'];
    $nfirstname = $_POST['nextofkinfirstname'];
    $nlastname = $_POST['nextofkinlastname'];
    $nemail = $_POST['nextofkinemail'];
    $naddress = $_POST['nextofkinaddress'];
    $nphone = $_POST['nextofkinphone'];
    $nrelation = $_POST['relation'];
    $filename = $_FILES['image']['name'];
    $earning = $_POST['earning'];

if(empty($firstname) || empty($lastname) || empty($email) || empty($number)  || empty($nin) || empty($dob) || empty($nfirstname) || empty($nlastname) || empty($nemail) || empty($naddress) || empty($nphone) || empty($nrelation) || empty($unique) || empty($earning) || empty($address)){
    $errormsg = "Please input all fields";
}  
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errormsg = "Invalid email format";
      }
      
      else if(strlen($nin) !== 11){
        $errormsg = "Please input your NIN correctly";
    }  
      else if(empty($filename)){
        $errormsg = "Please Select Your File";
    }

    else {
    $user = new User;
    $emailuser = $user->checkEmailAddress(check_input($email));
    $emailuser2 = $user->checkAgentEmailAddress(check_input($email));
    $emailuser3 = $user->checkExecutiveEmailAddress(check_input($email));
    $emailuser4 = $user->checkSubadminEmailAddress(check_input($email));
    $emailuser5 = $user->checkSuperadminEmailAddress(check_input($email));
    $emailuser6 = $user->selectUserEmail($unique);
    if(!empty($emailuser2) || !empty($emailuser3) || !empty($emailuser4) || !empty($emailuser5)){
    $errormsg = "Email Address already exists";
    }else if($emailuser6['email'] != $email && !empty($emailuser)){
      $errormsg = "Email Address already exists";
    } else {
     $insertuser = $user->updateUserInfo(check_input($firstname),check_input($lastname),check_input($email),check_input($unique),check_input($number),check_input($nin),check_input($dob),check_input($nfirstname),check_input($nlastname),check_input($nemail),check_input($naddress),check_input($nphone),check_input($nrelation),check_input($earning),$address);
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