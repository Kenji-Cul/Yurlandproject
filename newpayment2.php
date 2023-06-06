<?php 
session_start();
if(!isset($_GET['user'])){
    header("Location: agentprofile.php");
}
include "projectlog.php";
if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
    header('Location: index.php');
}
?>
<?php

$user = new User;
$selectuser = $user->selectUser($_GET['user']);
if(isset($_SESSION['uniqueagent_id'])){
$selectagent = $user->selectAgent($_SESSION['uniqueagent_id']);
}
if(isset($_SESSION['uniquesubadmin_id'])){
$subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
}

if(isset($_SESSION['uniquesupadmin_id'])){
    $subadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
    }
   
    $landview = $user->selectLandImage($_GET['uniqueid']);
    $checklastpayment = $user->selectLastPay($_GET['user'],$_GET['uniqueid'],$_GET['newpayid']);
    $checklatestpayment = $user->selectLatestPay($_GET['user'],$_GET['uniqueid']);
    $checklastpaid = $user->selectSubPay($_GET['user']);
    if(!empty($landview)){
        foreach($landview as $key => $value){ 



// Integrate Paystack

   
if(isset($_POST["submit"])){
    if(isset($_SESSION['uniquesubadmin_id'])){
        if(isset($_POST['payment']) && !empty($_POST['payment'])){
            $plan = $_POST['payment'];
            if($plan == "offline payment"){
                if($_POST['period'] > $_POST['dayno']){
                    $error = "Limit Reached";
                    header("Location: verify3.php?error=".$error."");
                } else {
                    
                    if($checklatestpayment['product_id'] == $_GET['uniqueid'] && $checklatestpayment['newpay_id'] != $_GET['newpayid'] && $checklatestpayment['balance'] > "2"){
                        $error = "This customer has an ongoing subscription on this estate, please complete payment";
                        header("Location: verify3.php?error=".$error."");
                    } else {
                    if($checklastpayment['balance'] > "2" && isset($_GET['remprice'])){
                $email = htmlspecialchars($selectuser['email']);
                if(!isset($_GET['remprice'])){
                    if($_GET['data'] == "onemonth"){
                        $realprice = $_GET['subpayment'] * $_POST['period'];
                        $subprice = $_GET['subpayment'];
                        $limit = $value['onemonth_period'];
                        $increaserate = $value['onemonth_increaserate'];
                        } else if($_GET['data'] == "threemonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['threemonth_period'];
                        $increaserate = $value['threemonth_increaserate'];
                        } else if($_GET['data'] == "sixmonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['sixmonth_period'];
                        $increaserate = $value['sixmonth_increaserate'];
                        } else if($_GET['data'] == "twelvemonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['twelvemonth_period'];
                        $increaserate = $value['twelvemonth_increaserate'];
                        } else if($_GET['data'] == "eighteenmonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['eighteen_period'];
                        $increaserate = $value['eighteen_increaserate'];
                        }
                    }
            
                $price = $_GET['tot'];
                if(isset($_GET['newpay'])){
                    $newpay = $_GET['newpay'];
                    $realprice = round($newpay);
                } else {
                    $newpay = $realprice;
                }
            
                
               
                $newprice = $price - $realprice;
                if($newprice < 0){
                    $newprice = 0;
                }
                $uniqueperson = $_GET['user'];
                $uniqueproduct = $_GET['uniqueid'];
                $newpayid = $_GET['newpayid'];
                if(isset($_GET['remprice'])){
                   $period = $_GET['period'];
                   $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
                   $subperiod = $landuse['period_num'] - $_GET['subperiod'];
                   $firstDate = $landuse['increase_date'];
                   if($landuse['product_plan'] == "onemonth"){
                    $increaserate = $value['onemonth_increaserate'];
                    } else if($landuse['product_plan'] == "threemonths"){
                    $increaserate = $value['threemonth_increaserate'];
                    } else if($landuse['product_plan'] == "sixmonths"){
                    $increaserate = $value['sixmonth_increaserate'];
                    } else if($landuse['product_plan'] == "twelvemonths"){
                    $increaserate = $value['twelvemonth_increaserate'];
                    } else if($landuse['product_plan'] == "eighteenmonths"){
                    $increaserate = $value['eighteen_increaserate'];
                    }
                } else {
                    $time = $limit - intval($_POST['period']);
                $date = date("y-m-d");
                $date2 = date_create($date);
                $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
                $period = date_format($time2, "M-d-Y");
                $subperiod = $limit - intval($_POST['period']);
                $chosenplan = $_GET['data'];
                $firstDate = $_POST['planindicator'];
                }
                
                $product_name = $value['product_name'];
                $product_desc = $value['product_description'];
                $allocationfee = $value['allocation_fee'];
               
            
                if(isset($_GET['remunit'])){
                    $deducted_unit = $value['product_unit'];
                }else {
                    $deducted_unit = $value['product_unit'] - $_GET['unit'];
                }
                   
                if(isset($_GET['remunit'])){
                    $boughtunit = $value['bought_units'];
                }else {
                    $boughtunit = $_GET['unit']  + $value['bought_units'];
                }
            
               
                $productlocation = $value['product_location'];
                $image = $value['product_image'];
                $paymentmonth = date("M");
                $paymentday = date("d");
                $paymentyear = date("Y");
                $paymenttime = date("h:i a");
                $paymentdate = date("M-d-Y");
                $paymentmethod = "NewPayment";
                $offlinestatus = "Pending";
                $paymentmode = "Offline";
                
                if(isset($_SESSION['uniqueagent_id'])){
                    $payee = $selectagent['agent_name'];
                    $agentid = $selectagent['uniqueagent_id'];
                } 
                  else {
                if($selectuser['referral_id'] != "Yurland"){
                    $agent = $user->selectAgentRef($selectuser['referral_id']);
                    $userperson = $user->selectUserRef($selectuser['referral_id']);
                    if(!empty($agent)){
                        $agentid= $agent['uniqueagent_id'];
                    } else {
                        $agentid = $userperson['unique_id'];
                    }
                   
                } else {
                    $agentid = "noagent";
                }

                    if(isset($_SESSION['uniquesubadmin_id'])){
                        $payee = $subadmin['subadmin_name'];
                    }
                
                    if(isset($_SESSION['uniquesupadmin_id'])){
                        $payee = $subadmin['super_adminname'];
                    }


                }      
                
                
                if($_GET['unit'] % 4 == 0){
                    $unit_added = $_GET['unit'] / 4;
                    $added_unit = $_GET['unit'] + $unit_added;
               

                $addedprice = $checklastpayment['product_price'] + round($newpay);
if(round($newprice) < 1){
    $uniquename = rand();
    $filename = "allocationletter".$uniquename.".pdf";
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
   
    
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

      $selectuser = $user->selectUser($uniqueperson);
    header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".round($newpay)."&balance=".round($newprice)."&payer=".$payee."&email=".$selectuser['email']."");
}
$updatepay = $user->updateNewPayment($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$added_unit,$payment_method,$paymentdate,round($newprice),$period,$subperiod,$payee,$agentid,$allocationfee,$newpayid,$firstDate,$increaserate);

$executives = $user->selectAllExecutive();
if(!empty($executives)){
foreach($executives as $key => $value){
  $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}
}

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if(!empty($userearnee)){
$earnerid = $userearnee['unique_id'];
$earnee = $userearnee['first_name']." ".$userearnee['last_name'];
$earnedamount = $userearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if($agentid == "noagent"){
$earnerid = "Yurland";
$earnee = "Yurland";
$userearnee = $user->selectUser($uniqueperson);
$earnedamount = $userearnee['yurland_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}


$inserthistory = $user->insertUpdateHistory3($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$added_unit,$payment_method,$paymentdate,round($newprice),$period,$_GET['subperiod'],$product_name,$payee,$agentid,$allocationfee,$newpayid,$offlinestatus,$paymentmode);

$username = $user->selectUser($uniqueperson);
$customername = $username['first_name']." ".$username['last_name'];
$paymentdate = date("M-d-Y");
$unitprice = round($newpay);
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = round($newprice);
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
header("Location: successemail.php?name=".$customername."&date=".$paymentdate."&amount=".$amount3."&estate=".$product_name."&payer=".$payee."&balance=".$amount4."&email=".$username['email']."");

  
}  else {
$addedprice = $checklastpayment['product_price'] + round($newpay);
    if(round($newprice) < 1){
        $uniquename = rand();
        $filename = "allocationletter".$uniquename.".pdf";
        $selectuser = $user->selectUser($uniqueperson);
        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
       
        
          if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
            $allocationfee2 = number_format($allocationfee);
          } else {
            $allocationfee2 =  round($allocationfee);
          }
    
          $selectuser = $user->selectUser($uniqueperson);
        header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".round($newpay)."&balance=".round($newprice)."&payer=".$payee."&email=".$selectuser['email']."");

        $updatepay = $user->updateNewPayment2($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$_GET['unit'],$paymentmethod,$paymentdate,round($newprice),$period,$subperiod,$payee,$agentid,$allocationfee,$filename,$newpayid);

        $executives = $user->selectAllExecutive();
if(!empty($executives)){
foreach($executives as $key => $value){
  $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}
}

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if(!empty($userearnee)){
$earnerid = $userearnee['unique_id'];
$earnee = $userearnee['first_name']." ".$userearnee['last_name'];
$earnedamount = $userearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if($agentid == "noagent"){
$earnerid = "Yurland";
$earnee = "Yurland";
$userearnee = $user->selectUser($uniqueperson);
$earnedamount = $userearnee['yurland_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}


        $inserthistory = $user->insertUpdateHistory4($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$_GET['unit'],$paymentmethod,$paymentdate,round($newprice),$period,$subperiod,$product_name,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
    } else {
        $updatepay = $user->updateNewPayment($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$addedprice,$image,$_GET['unit'],$paymentmethod,$paymentdate,round($newprice),$period,$subperiod,$payee,$agentid,$allocationfee,$newpayid,$firstDate,$increaserate);

        $executives = $user->selectAllExecutive();
if(!empty($executives)){
foreach($executives as $key => $value){
  $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}
}

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if(!empty($userearnee)){
$earnerid = $userearnee['unique_id'];
$earnee = $userearnee['first_name']." ".$userearnee['last_name'];
$earnedamount = $userearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if($agentid == "noagent"){
$earnerid = "Yurland";
$earnee = "Yurland";
$userearnee = $user->selectUser($uniqueperson);
$earnedamount = $userearnee['yurland_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}


        $inserthistory = $user->insertUpdateHistory3($uniqueperson,$uniqueproduct,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$_GET['unit'],$paymentmethod,$paymentdate,round($newprice),$period,$_GET['subperiod'],$product_name,$payee,$agentid,$allocationfee,$newpayid,$offlinestatus,$paymentmode);

        $username = $user->selectUser($uniqueperson);
        $customername = $username['first_name']." ".$username['last_name'];
        $paymentdate = date("M-d-Y");
        $unitprice = round($newpay);
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount3 = number_format($unitprice);
} else {
$amount3 = round($unitprice);
}

$unitprice2 = round($newprice);
if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
$amount4 = number_format($unitprice2);
} else {
$amount4 = round($unitprice2);
}
        header("Location: successemail.php?name=".$customername."&date=".$paymentdate."&amount=".$amount3."&estate=".$product_name."&payer=".$payee."&balance=".$amount4."&email=".$username['email']."");
    }

}

$updatenewpayment = $user->updatePayment($uniqueproduct,$uniqueperson,$newpayid);
$update = $user->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
   if(isset($_SESSION['unique_id'])){
   $delete = $user->DeleteCartId($uniqueproduct,$_SESSION['unique_id']);
   if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$uniqueproduct]);
    
}
   }

if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
    $delete = $user->DeleteCartId($uniqueproduct,$uniqueperson);
    if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
     // Remove the product from the shopping cart
     unset($_SESSION['cart'][$uniqueproduct]);
}
}
}
                    
            
               
    
               
            } 
                    
            
            
            if(empty($checklastpayment)){
                $landsub = $user->selectSubProduct($checklastpaid['product_id']);
               
               
                if($checklastpaid['product_plan'] == "onemonth"){
                    $totalsubprice = $landsub['onemonth_percent'] / 100 * $landsub['onemonth_price'];
                  } else if($checklastpaid['product_plan'] == "threemonths"){
                    $totalsubprice = $landsub['threemonth_percent'] / 100 * $landsub['onemonth_price'];
                  }  else if($checklastpaid['product_plan'] == "sixmonths"){
                    $totalsubprice = $landsub['sixmonth_percent'] / 100 * $landsub['onemonth_price'];
                  } else if($checklastpaid['product_plan'] == "twelvemonths"){
                    $totalsubprice = $landsub['twelvemonth_percent'] / 100 * $landsub['onemonth_price'];
                  } 
            
                  else if($checklastpaid['product_plan'] == "eighteenmonths"){
                    $totalsubprice = $landsub['eighteen_percent'] / 100 * $landsub['onemonth_price'];
                  }
            
                  $totprice = $checklastpaid['product_unit'] * $landsub['onemonth_price'];
                    $price = $totprice + $totalsubprice;
                    $pricepercent = 70 / 100 * round($price);
                  
                 
                if($checklastpaid['product_price'] < $pricepercent && !isset($_GET['remprice'])){
                    $error = "Current plan is below 70% payment,please payup to qualify for another location on Subscription";
                    header("Location: verify3.php?error=".$error."");
                } else { 
                $email = htmlspecialchars($selectuser['email']);
                if(!isset($_GET['remprice'])){
                    if($_GET['data'] == "onemonth"){
                        $realprice = $_GET['subpayment'] * $_POST['period'];
                        $subprice = $_GET['subpayment'];
                        $limit = $value['onemonth_period'];
                        $increaserate = $value['onemonth_increaserate'];
                        } else if($_GET['data'] == "threemonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['threemonth_period'];
                        $increaserate = $value['threemonth_increaserate'];
                        } else if($_GET['data'] == "sixmonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['sixmonth_period'];
                        $increaserate = $value['sixmonth_increaserate'];
                        } else if($_GET['data'] == "twelvemonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['twelvemonth_period'];
                        $increaserate = $value['twelvemonth_increaserate'];
                        } else if($_GET['data'] == "eighteenmonths"){
                            $realprice = $_GET['subpayment'] * $_POST['period'];
                            $subprice = $_GET['subpayment'];
                        $limit = $value['eighteen_period'];
                        $increaserate = $value['eighteen_increaserate'];
                        }
                    }
            
                $price = $_GET['tot'];
                if(isset($_GET['newpay'])){
                    $newpay = $_GET['newpay'];
                    $realprice = round($newpay);
                } else {
                    $newpay = $realprice;
                }
               
                $newprice = $price - $realprice;
                if($newprice < 0){
                    $newprice = 0;
                }
                $uniqueperson = $_GET['user'];
                $uniqueproduct = $_GET['uniqueid'];
                if(isset($_GET['remprice'])){
                   $period = $_GET['period'];
                   $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
                   $subperiod = $landuse['period_num'] - $_GET['subperiod'];
                   $firstDate = $landuse['increase_date'];
                   if($landuse['product_plan'] == "onemonth"){
                    $increaserate = $value['onemonth_increaserate'];
                    } else if($landuse['product_plan'] == "threemonths"){
                    $increaserate = $value['threemonth_increaserate'];
                    } else if($landuse['product_plan'] == "sixmonths"){
                    $increaserate = $value['sixmonth_increaserate'];
                    } else if($landuse['product_plan'] == "twelvemonths"){
                    $increaserate = $value['twelvemonth_increaserate'];
                    } else if($landuse['product_plan'] == "eighteenmonths"){
                    $increaserate = $value['eighteen_increaserate'];
                    }
                } else {
                    $time = $limit - intval($_POST['period']);
                $date = date("y-m-d");
                $date2 = date_create($date);
                $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
                $period = date_format($time2, "M-d-Y");
                $subperiod = $limit - intval($_POST['period']);
                $chosenplan = $_GET['data'];
                $firstDate = $_POST['planindicator'];
                }
                
                $product_name = $value['product_name'];
                $product_desc = $value['product_description'];
                $allocationfee = $value['allocation_fee'];
                
            
                if(isset($_GET['remunit'])){
                    $deducted_unit = $value['product_unit'];
                }else {
                    $deducted_unit = $value['product_unit'] - $_GET['unit'];
                }
                   
                if(isset($_GET['remunit'])){
                    $boughtunit = $value['bought_units'];
                }else {
                    $boughtunit = $_GET['unit']  + $value['bought_units'];
                }
            
               
                $productlocation = $value['product_location'];
                $image = $value['product_image'];
                $paymentmonth = date("M");
                $paymentday = date("d");
                $paymentyear = date("Y");
                $paymenttime = date("h:i a");
                $paymentdate = date("M-d-Y");
                $paymentmethod = "NewPayment";
                $offlinestatus = "Pending";
                $paymentmode = "Offline";
               
                if(isset($_SESSION['uniqueagent_id'])){
                    $payee = $selectagent['agent_name'];
                    $agentid = $selectagent['uniqueagent_id'];
                } 
            
                if(isset($_SESSION['uniquesubadmin_id'])){
                    $payee = $subadmin['subadmin_name'];
                    $agentid = "noagent";
                }
            
                if(isset($_SESSION['uniquesupadmin_id'])){
                    $payee = $subadmin['super_adminname'];
                    $agentid = "noagent";
                }
            
                $newpayid = rand();
                  
                if($_GET['unit'] % 4 == 0){
                    $unit_added = $_GET['unit'] / 4;
                    $added_unit = $_GET['unit'] + $unit_added;
               
                    $uniquename = rand();
                    $filename = "offerletter".$uniquename.".pdf";
                    $selectuser = $user->selectUser($uniqueperson);
                    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                    $newbalance = round($newpay) + round($newprice);
                    if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
                        $newbalance2 = number_format($newbalance);
                      } else {
                          $newbalance2 =  $newbalance;
                      }
                      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                        $allocationfee2 = number_format($allocationfee);
                      } else {
                        $allocationfee2 =  round($allocationfee);
                      }
                
                      if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
                        $subprice2 = number_format(ceil($subprice));
                      } else {
                        $subprice2 =  ceil($subprice);
                      }
                    header("Location: offer.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$added_unit."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$subperiod."&enddate=".$period."&customer=".$name."&amount=".round($newpay)."&balance=".round($newprice)."&payer=".$payee."&email=".$selectuser['email']."");

                    
                    $insertpayment = $user->insertNewPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$added_unit,$paymentmethod,round($newprice),$period,$subperiod,round($newpay),$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newbalance,$newpayid,$firstDate,$increaserate);
                
                    $executives = $user->selectAllExecutive();
                    if(!empty($executives)){
                    foreach($executives as $key => $value){
                      $earnerid = $value['unique_id'];
                $earnee = $value['full_name'];
                $earnedamount = $value['earning'] / 100 * round($newpay);
                $selectuser = $user->selectUser($uniqueperson);
                $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                      $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                    }
                  }
                
                $agentearnee = $user->selectAgent($agentid);
                $userearnee = $user->selectUser($agentid);
                
                if(!empty($agentearnee)){
                $earnerid = $agentearnee['uniqueagent_id'];
                $earnee = $agentearnee['agent_name'];
                $earnedamount = $agentearnee['earning_percentage'] / 100 * round($newpay);
                $selectuser = $user->selectUser($uniqueperson);
                $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                }
                
                if(!empty($userearnee)){
                  $earnerid = $userearnee['unique_id'];
                  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
                  $earnedamount = $userearnee['earning_percentage'] / 100 * round($newpay);
                  $selectuser = $user->selectUser($uniqueperson);
                  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                  $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                  }
                
                  if($agentid == "noagent"){
                    $earnerid = "Yurland";
                    $earnee = "Yurland";
                    $userearnee = $user->selectUser($uniqueperson);
                    $earnedamount = $userearnee['yurland_percentage'] / 100 * round($newpay);
                    $selectuser = $user->selectUser($uniqueperson);
                    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                    $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                    }
                
                    $inserthistory = $user->insertNewPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$added_unit,$paymentmethod,round($newpay),$period,$_POST['period'],round($newpay),$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
                } else {
                    $uniquename = rand();
        $filename = "offerletter".$uniquename.".pdf";
        $selectuser = $user->selectUser($uniqueperson);
        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
        $newbalance = round($newpay) + round($newprice);
        if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
            $newbalance2 = number_format($newbalance);
          } else {
              $newbalance2 =  $newbalance;
          }
          if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
            $allocationfee2 = number_format($allocationfee);
          } else {
            $allocationfee2 =  round($allocationfee);
          }
    
          if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
            $subprice2 = number_format(ceil($subprice));
          } else {
            $subprice2 =  ceil($subprice);
          }
        header("Location: offer.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&totalcost=".$newbalance2."&allocationfee=".$allocationfee2."&units=".$_GET['unit']."&subprice=".$subprice2."&paydate=".$paymentdate."&period=".$subperiod."&enddate=".$period."&customer=".$name."&amount=".round($newpay)."&balance=".round($newprice)."&payer=".$payee."&email=".$selectuser['email']."");
   $insertpayment = $user->insertNewPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$_GET['unit'],$paymentmethod,round($newprice),$period,$subperiod,round($newpay),$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newbalance,$newpayid,$firstDate,$increaserate);

   $executives = $user->selectAllExecutive();
    if(!empty($executives)){
    foreach($executives as $key => $value){
      $earnerid = $value['unique_id'];
$earnee = $value['full_name'];
$earnedamount = $value['earning'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
      $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
    }
  }

$agentearnee = $user->selectAgent($agentid);
$userearnee = $user->selectUser($agentid);

if(!empty($agentearnee)){
$earnerid = $agentearnee['uniqueagent_id'];
$earnee = $agentearnee['agent_name'];
$earnedamount = $agentearnee['earning_percentage'] / 100 * round($newpay);
$selectuser = $user->selectUser($uniqueperson);
$name = $selectuser['first_name'].' '.$selectuser['last_name'];
$insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
}

if(!empty($userearnee)){
  $earnerid = $userearnee['unique_id'];
  $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
  $earnedamount = $userearnee['earning_percentage'] / 100 * round($newpay);
  $selectuser = $user->selectUser($uniqueperson);
  $name = $selectuser['first_name'].' '.$selectuser['last_name'];
  $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
  }

  if($agentid == "noagent"){
    $earnerid = "Yurland";
    $earnee = "Yurland";
    $userearnee = $user->selectUser($uniqueperson);
    $earnedamount = $userearnee['yurland_percentage'] / 100 * round($newpay);
    $selectuser = $user->selectUser($uniqueperson);
    $name = $selectuser['first_name'].' '.$selectuser['last_name'];
    $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,round($newpay),$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
    }



   $inserthistory = $user->insertNewPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,round($newpay),$image,$_GET['unit'],$paymentmethod,round($newprice),$period,$_POST['period'],round($newpay),$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
  
   
                }          
            
                $updatenewpayment = $user->updatePayment($uniqueproduct,$uniqueperson,$newpayid);
                $update = $user->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
   if(isset($_SESSION['unique_id'])){
   $delete = $user->DeleteCartId($uniqueproduct,$_SESSION['unique_id']);
   if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$uniqueproduct]);
    
}
   }

if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesubadmin_id']) || isset($_SESSION['uniquesupadmin_id'])){
    $delete = $user->DeleteCartId($uniqueproduct,$uniqueperson);
    if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
     // Remove the product from the shopping cart
     unset($_SESSION['cart'][$uniqueproduct]);
}
}
               
            }
            
            
            
                    }
            
                }


            } 
            if($plan == "online payment"){
    if($_POST['period'] > $_POST['dayno']){
        $error = "Limit Reached";
        header("Location: verify3.php?error=".$error."");
    } else {
        if($checklatestpayment['product_id'] == $_GET['uniqueid'] && $checklatestpayment['newpay_id'] != $_GET['newpayid'] && $checklatestpayment['balance'] > "2"){
            $error = "This customer has an ongoing subscription on this estate, please complete payment";
            header("Location: verify3.php?error=".$error."");
        } else {
        if($checklastpayment['balance'] > "2" && isset($_GET['remprice'])){
    $email = htmlspecialchars($selectuser['email']);
    if(!isset($_GET['remprice'])){
        if($_GET['data'] == "onemonth"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
            $limit = $value['onemonth_period'];
            $increaserate = $value['onemonth_increaserate'];
            } else if($_GET['data'] == "threemonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['threemonth_period'];
            $increaserate = $value['threemonth_increaserate'];
            } else if($_GET['data'] == "sixmonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['sixmonth_period'];
            $increaserate = $value['sixmonth_increaserate'];
            } else if($_GET['data'] == "twelvemonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['twelvemonth_period'];
            $increaserate = $value['twelvemonth_increaserate'];
            } else if($_GET['data'] == "eighteenmonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['eighteen_period'];
            $increaserate = $value['eighteen_increaserate'];
            }
        }

    $price = $_GET['tot'];
    if(isset($_GET['newpay'])){
        $newpay = $_GET['newpay'];
        $realprice = round($newpay);
    } else {
        $newpay = $realprice;
    }

    
   
    $newprice = $price - $realprice;
    if($newprice < 0){
        $newprice = 0;
    }
    $uniqueperson = $_GET['user'];
    $uniqueproduct = $_GET['uniqueid'];
    $newpayid = $_GET['newpayid'];
    if(isset($_GET['remprice'])){
       $period = $_GET['period'];
       $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
       $subperiod = $landuse['period_num'] - $_GET['subperiod'];
       $firstDate = $landuse['increase_date'];
       if($landuse['product_plan'] == "onemonth"){
        $increaserate = $value['onemonth_increaserate'];
        } else if($landuse['product_plan'] == "threemonths"){
        $increaserate = $value['threemonth_increaserate'];
        } else if($landuse['product_plan'] == "sixmonths"){
        $increaserate = $value['sixmonth_increaserate'];
        } else if($landuse['product_plan'] == "twelvemonths"){
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($landuse['product_plan'] == "eighteenmonths"){
        $increaserate = $value['eighteen_increaserate'];
        }
    } else {
        $time = $limit - intval($_POST['period']);
    $date = date("y-m-d");
    $date2 = date_create($date);
    $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
    $period = date_format($time2, "M-d-Y");
    $subperiod = $limit - intval($_POST['period']);
    $chosenplan = $_GET['data'];
    $firstDate = $_POST['planindicator'];
    }
    
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
   

    if(isset($_GET['remunit'])){
        $deducted_unit = $value['product_unit'];
    }else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
    }
       
    if(isset($_GET['remunit'])){
        $boughtunit = $value['bought_units'];
    }else {
        $boughtunit = $_GET['unit']  + $value['bought_units'];
    }

   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "NewPayment";
    
    if(isset($_SESSION['uniqueagent_id'])){
        $payee = $selectagent['agent_name'];
        $agentid = $selectagent['uniqueagent_id'];
    } 
      else {
    if($selectuser['referral_id'] != "Yurland"){
        $agent = $user->selectAgentRef($selectuser['referral_id']);
        $userperson = $user->selectUserRef($selectuser['referral_id']);
        if(!empty($agent)){
            $agentid= $agent['uniqueagent_id'];
        } else {
            $agentid = $userperson['unique_id'];
        }
       
    } else {
        $agentid = "noagent";
    }
        if(isset($_SESSION['uniquesubadmin_id'])){
            $payee = $subadmin['subadmin_name'];
        }
    
        if(isset($_SESSION['uniquesupadmin_id'])){
            $payee = $subadmin['super_adminname'];
        }
    
    

}
        

   
 
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => round($realprice * 100),
       "callback_url" => "http://localhost/Yurland/verify.php",
       "metadata" => [
          "custom_fields" => [
            [
                "display_name" => "Unique Product",
                "variable_name" => "product",
                "value" => $uniqueproduct
            ],

            [
                "display_name" => "Deducted Unit",
                "variable_name" => "unit",
                "value" => $deducted_unit
            ],

            [
                "display_name" => "Bought Units",
                "variable_name" => "boughtunit",
                "value" => $boughtunit
            ],

            [
                "display_name" => "Unique Person",
                "variable_name" => "person",
                "value" => $uniqueperson
            ],

            [
                "display_name" => "Product Name",
                "variable_name" => "productname",
                "value" => $product_name
            ],

            [
                "display_name" => "Payment Month",
                "variable_name" => "paymonth",
                "value" => $paymentmonth
            ],

            [
                "display_name" => "Payment Day",
                "variable_name" => "payday",
                "value" => $paymentday
            ],

            [
                "display_name" => "Payment Year",
                "variable_name" => "payyear",
                "value" => $paymentyear
            ],

            [
                "display_name" => "Payment Time",
                "variable_name" => "paytime",
                "value" => $paymenttime
            ],

            [
                "display_name" => "Product Location",
                "variable_name" => "productlocation",
                "value" => $productlocation
            ],

            [
                "display_name" => "Price",
                "variable_name" => "price",
                "value" => round($price)
            ],

            [
                "display_name" => "Product Image",
                "variable_name" => "prodimage",
                "value" => $image
            ],
            [
                "display_name" => "Payment Method",
                "variable_name" => "paymethod",
                "value" => $paymentmethod
            ],

            [
                "display_name" => "Payment Unit",
                "variable_name" => "payunit",
                "value" => $_GET['unit']
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "newpayment"
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newprice)
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newpay)
            ],

            [
                "display_name" => "Period",
                "variable_name" => "period",
                "value" => $period
            ],

            [
                "display_name" => "Sub Period",
                "variable_name" => "subperiod",
                "value" => $subperiod
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

            
            [
                "display_name" => "Payee",
                "variable_name" => "payee",
                "value" => $payee
            ],

            [
                "display_name" => "Agentid",
                "variable_name" => "Agentid",
                "value" => $agentid
            ],

            [
                "display_name" => "Allocation Fee",
                "variable_name" => "allocation fee",
                "value" =>  $allocationfee
            ],

            [
                "display_name" => "NewPay Id",
                "variable_name" => "newpayid",
                "value" => $newpayid
            ],


            [
                "display_name" => "Chosen Plan",
                "variable_name" => "chosenplan",
                "value" => $chosenplan
            ],

            [
                "display_name" => "Sub Price",
                "variable_name" => "subprice",
                "value" => $subprice
            ],

            [
                "display_name" => "First Date",
                "variable_name" => "First Date",
                "value" => $firstDate
            ],

            [
                "display_name" => "Increase Rate",
                "variable_name" => "Increase Rate",
                "value" => $increaserate
            ],
          
           

          ]
       ]
    ];

    // Generate a URL-encoded string
    $encode_transaction_data = http_build_query($transaction_data);

    // Open Connection to cURL
    $ch = curl_init();

    // Turn off Mandatory SSL checking
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Set the url
    curl_setopt($ch, CURLOPT_URL, $url);

    // Enable data to be sent in POST arrays
    curl_setopt($ch, CURLOPT_POST, true);

    // Collect the posted data from above
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
    
    //Set the headers from the endpoint
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-Control: no-cache"
    ));

    // Make curl return the data instead of echoing
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    
    // Check for errors
    $errors = curl_error($ch);
    if($errors){
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

    if($result){
    
        //echo $result;
        $transaction = json_decode($result);
      //Automatically redirect customers to the payment page
        header("Location: ".$transaction->data->authorization_url);
    }
    
    
    else {
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }


} 
        


if(empty($checklastpayment)){
    $landsub = $user->selectSubProduct($checklastpaid['product_id']);
   
   
    if($checklastpaid['product_plan'] == "onemonth"){
        $totalsubprice = $landsub['onemonth_percent'] / 100 * $landsub['onemonth_price'];
      } else if($checklastpaid['product_plan'] == "threemonths"){
        $totalsubprice = $landsub['threemonth_percent'] / 100 * $landsub['onemonth_price'];
      }  else if($checklastpaid['product_plan'] == "sixmonths"){
        $totalsubprice = $landsub['sixmonth_percent'] / 100 * $landsub['onemonth_price'];
      } else if($checklastpaid['product_plan'] == "twelvemonths"){
        $totalsubprice = $landsub['twelvemonth_percent'] / 100 * $landsub['onemonth_price'];
      } 

      else if($checklastpaid['product_plan'] == "eighteenmonths"){
        $totalsubprice = $landsub['eighteen_percent'] / 100 * $landsub['onemonth_price'];
      }

      $totprice = $checklastpaid['product_unit'] * $landsub['onemonth_price'];
        $price = $totprice + $totalsubprice;
        $pricepercent = 70 / 100 * round($price);
      
     
    if($checklastpaid['product_price'] < $pricepercent && !isset($_GET['remprice'])){
        $error = "Current plan is below 70% payment,please payup to qualify for another location on Subscription";
        header("Location: verify3.php?error=".$error."");
    } else { 
    $email = htmlspecialchars($selectuser['email']);
    if(!isset($_GET['remprice'])){
        if($_GET['data'] == "onemonth"){
            $realprice = $_GET['subpayment'] * $_POST['period'];
            $subprice = $_GET['subpayment'];
            $limit = $value['onemonth_period'];
            $increaserate = $value['onemonth_increaserate'];
            } else if($_GET['data'] == "threemonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['threemonth_period'];
            $increaserate = $value['threemonth_increaserate'];
            } else if($_GET['data'] == "sixmonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['sixmonth_period'];
            $increaserate = $value['sixmonth_increaserate'];
            } else if($_GET['data'] == "twelvemonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['twelvemonth_period'];
            $increaserate = $value['twelvemonth_increaserate'];
            } else if($_GET['data'] == "eighteenmonths"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
            $limit = $value['eighteen_period'];
            $increaserate = $value['eighteen_increaserate'];
            }
        }

    $price = $_GET['tot'];
    if(isset($_GET['newpay'])){
        $newpay = $_GET['newpay'];
        $realprice = round($newpay);
    } else {
        $newpay = $realprice;
    }
   
    $newprice = $price - $realprice;
    if($newprice < 0){
        $newprice = 0;
    }
    $uniqueperson = $_GET['user'];
    $uniqueproduct = $_GET['uniqueid'];
    if(isset($_GET['remprice'])){
       $period = $_GET['period'];
       $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
       $subperiod = $landuse['period_num'] - $_GET['subperiod'];
       $firstDate = $landuse['increase_date'];
       if($landuse['product_plan'] == "onemonth"){
        $increaserate = $value['onemonth_increaserate'];
        } else if($landuse['product_plan'] == "threemonths"){
        $increaserate = $value['threemonth_increaserate'];
        } else if($landuse['product_plan'] == "sixmonths"){
        $increaserate = $value['sixmonth_increaserate'];
        } else if($landuse['product_plan'] == "twelvemonths"){
        $increaserate = $value['twelvemonth_increaserate'];
        } else if($landuse['product_plan'] == "eighteenmonths"){
        $increaserate = $value['eighteen_increaserate'];
        }
    } else {
        $time = $limit - intval($_POST['period']);
    $date = date("y-m-d");
    $date2 = date_create($date);
    $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
    $period = date_format($time2, "M-d-Y");
    $subperiod = $limit - intval($_POST['period']);
    $chosenplan = $_GET['data'];
    $firstDate = $_POST['planindicator'];
    }
    
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
    

    if(isset($_GET['remunit'])){
        $deducted_unit = $value['product_unit'];
    }else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
    }
       
    if(isset($_GET['remunit'])){
        $boughtunit = $value['bought_units'];
    }else {
        $boughtunit = $_GET['unit']  + $value['bought_units'];
    }

   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "NewPayment";
   
    if(isset($_SESSION['uniqueagent_id'])){
        $payee = $selectagent['agent_name'];
        $agentid = $selectagent['uniqueagent_id'];
    } 

    if(isset($_SESSION['uniquesubadmin_id'])){
        $payee = $subadmin['subadmin_name'];
        $agentid = "noagent";
    }

    if(isset($_SESSION['uniquesupadmin_id'])){
        $payee = $subadmin['super_adminname'];
        $agentid = "noagent";
    }

    $newpayid = rand();
 
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => round($realprice * 100),
       "callback_url" => "http://localhost/Yurland/verify.php",
       "metadata" => [
          "custom_fields" => [
            [
                "display_name" => "Unique Product",
                "variable_name" => "product",
                "value" => $uniqueproduct
            ],

            [
                "display_name" => "Deducted Unit",
                "variable_name" => "unit",
                "value" => $deducted_unit
            ],

            [
                "display_name" => "Bought Units",
                "variable_name" => "boughtunit",
                "value" => $boughtunit
            ],

            [
                "display_name" => "Unique Person",
                "variable_name" => "person",
                "value" => $uniqueperson
            ],

            [
                "display_name" => "Product Name",
                "variable_name" => "productname",
                "value" => $product_name
            ],

            [
                "display_name" => "Payment Month",
                "variable_name" => "paymonth",
                "value" => $paymentmonth
            ],

            [
                "display_name" => "Payment Day",
                "variable_name" => "payday",
                "value" => $paymentday
            ],

            [
                "display_name" => "Payment Year",
                "variable_name" => "payyear",
                "value" => $paymentyear
            ],

            [
                "display_name" => "Payment Time",
                "variable_name" => "paytime",
                "value" => $paymenttime
            ],

            [
                "display_name" => "Product Location",
                "variable_name" => "productlocation",
                "value" => $productlocation
            ],

            [
                "display_name" => "Price",
                "variable_name" => "price",
                "value" => round($price)
            ],

            [
                "display_name" => "Product Image",
                "variable_name" => "prodimage",
                "value" => $image
            ],
            [
                "display_name" => "Payment Method",
                "variable_name" => "paymethod",
                "value" => $paymentmethod
            ],

            [
                "display_name" => "Payment Unit",
                "variable_name" => "payunit",
                "value" => $_GET['unit']
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "newpayment"
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newprice)
            ],

            [
                "display_name" => "New Price",
                "variable_name" => "newprice",
                "value" => round($newpay)
            ],

            [
                "display_name" => "Period",
                "variable_name" => "period",
                "value" => $period
            ],

            [
                "display_name" => "Sub Period",
                "variable_name" => "subperiod",
                "value" => $subperiod
            ],

            [
                "display_name" => "Payment Date",
                "variable_name" => "paydate",
                "value" => $paymentdate
            ],

            
            [
                "display_name" => "Payee",
                "variable_name" => "payee",
                "value" => $payee
            ],

            [
                "display_name" => "Agentid",
                "variable_name" => "Agentid",
                "value" => $agentid
            ],

            [
                "display_name" => "Allocation Fee",
                "variable_name" => "allocation fee",
                "value" =>  $allocationfee
            ],

            [
                "display_name" => "NewPay Id",
                "variable_name" => "newpayid",
                "value" => $newpayid
            ],


            [
                "display_name" => "Chosen Plan",
                "variable_name" => "chosenplan",
                "value" => $chosenplan
            ],

            [
                "display_name" => "Sub Price",
                "variable_name" => "subprice",
                "value" => $subprice
            ],
          
            [
                "display_name" => "First Date",
                "variable_name" => "First Date",
                "value" => $firstDate
            ],

            [
                "display_name" => "Increase Rate",
                "variable_name" => "Increase Rate",
                "value" => $increaserate
            ],
           

          ]
       ]
    ];

    // Generate a URL-encoded string
    $encode_transaction_data = http_build_query($transaction_data);

    // Open Connection to cURL
    $ch = curl_init();

    // Turn off Mandatory SSL checking
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //Set the url
    curl_setopt($ch, CURLOPT_URL, $url);

    // Enable data to be sent in POST arrays
    curl_setopt($ch, CURLOPT_POST, true);

    // Collect the posted data from above
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
    
    //Set the headers from the endpoint
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
        "cache-Control: no-cache"
    ));

    // Make curl return the data instead of echoing
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL
    $result = curl_exec($ch);
    
    // Check for errors
    $errors = curl_error($ch);
    if($errors){
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

    if($result){
    
        //echo $result;
        $transaction = json_decode($result);
      //Automatically redirect customers to the payment page
        header("Location: ".$transaction->data->authorization_url);
    }
    
    
    else {
        $error = "You are not connected to the internet";
        header("Location: verify3.php?error=".$error."");
    }

}


}
        }

    }
}

    
        }}
    
    if(isset($_SESSION['uniqueagent_id']) || $_SESSION['uniquesupadmin_id']){
        if($_POST['period'] > $_POST['dayno']){
            $error = "Limit Reached";
            header("Location: verify3.php?error=".$error."");
        } else {
            if($checklatestpayment['product_id'] == $_GET['uniqueid'] && $checklatestpayment['newpay_id'] != $_GET['newpayid'] && $checklatestpayment['balance'] > "2"){
                $error = "This customer has an ongoing subscription on this estate, please complete payment";
                header("Location: verify3.php?error=".$error."");
            } else {
            if($checklastpayment['balance'] > "2" && isset($_GET['remprice'])){
        $email = htmlspecialchars($selectuser['email']);
        if(!isset($_GET['remprice'])){
            if($_GET['data'] == "onemonth"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
                $limit = $value['onemonth_period'];
                $increaserate = $value['onemonth_increaserate'];
                } else if($_GET['data'] == "threemonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['threemonth_period'];
                $increaserate = $value['threemonth_increaserate'];
                } else if($_GET['data'] == "sixmonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['sixmonth_period'];
                $increaserate = $value['sixmonth_increaserate'];
                } else if($_GET['data'] == "twelvemonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['twelvemonth_period'];
                $increaserate = $value['twelvemonth_increaserate'];
                } else if($_GET['data'] == "eighteenmonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['eighteen_period'];
                $increaserate = $value['eighteen_increaserate'];
                }
            }
    
        $price = $_GET['tot'];
        if(isset($_GET['newpay'])){
            $newpay = $_GET['newpay'];
            $realprice = round($newpay);
        } else {
            $newpay = $realprice;
        }
    
        
       
        $newprice = $price - $realprice;
        if($newprice < 0){
            $newprice = 0;
        }
        $uniqueperson = $_GET['user'];
        $uniqueproduct = $_GET['uniqueid'];
        $newpayid = $_GET['newpayid'];
        if(isset($_GET['remprice'])){
           $period = $_GET['period'];
           $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
           $subperiod = $landuse['period_num'] - $_GET['subperiod'];
           $firstDate = $landuse['increase_date'];
           if($landuse['product_plan'] == "onemonth"){
            $increaserate = $value['onemonth_increaserate'];
            } else if($landuse['product_plan'] == "threemonths"){
            $increaserate = $value['threemonth_increaserate'];
            } else if($landuse['product_plan'] == "sixmonths"){
            $increaserate = $value['sixmonth_increaserate'];
            } else if($landuse['product_plan'] == "twelvemonths"){
            $increaserate = $value['twelvemonth_increaserate'];
            } else if($landuse['product_plan'] == "eighteenmonths"){
            $increaserate = $value['eighteen_increaserate'];
            }
        } else {
            $time = $limit - intval($_POST['period']);
        $date = date("y-m-d");
        $date2 = date_create($date);
        $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
        $period = date_format($time2, "M-d-Y");
        $subperiod = $limit - intval($_POST['period']);
        $chosenplan = $_GET['data'];
        $firstDate = $_POST['planindicator'];
        }
        
        $product_name = $value['product_name'];
        $product_desc = $value['product_description'];
        $allocationfee = $value['allocation_fee'];
       
    
        if(isset($_GET['remunit'])){
            $deducted_unit = $value['product_unit'];
        }else {
            $deducted_unit = $value['product_unit'] - $_GET['unit'];
        }
           
        if(isset($_GET['remunit'])){
            $boughtunit = $value['bought_units'];
        }else {
            $boughtunit = $_GET['unit']  + $value['bought_units'];
        }
    
       
        $productlocation = $value['product_location'];
        $image = $value['product_image'];
        $paymentmonth = date("M");
        $paymentday = date("d");
        $paymentyear = date("Y");
        $paymenttime = date("h:i a");
        $paymentdate = date("M-d-Y");
        $paymentmethod = "NewPayment";
        
        if(isset($_SESSION['uniqueagent_id'])){
            $payee = $selectagent['agent_name'];
            $agentid = $selectagent['uniqueagent_id'];
        } 
          else {
        if($selectuser['referral_id'] != "Yurland"){
            $agent = $user->selectAgentRef($selectuser['referral_id']);
            $userperson = $user->selectUserRef($selectuser['referral_id']);
            if(!empty($agent)){
                $agentid= $agent['uniqueagent_id'];
            } else {
                $agentid = $userperson['unique_id'];
            }
           
        } else {
            $agentid = "noagent";
        }
            if(isset($_SESSION['uniquesubadmin_id'])){
                $payee = $subadmin['subadmin_name'];
            }
        
            if(isset($_SESSION['uniquesupadmin_id'])){
                $payee = $subadmin['super_adminname'];
            }
        
        
    
    }
            
    
       
     
       
    
    
        //Initiate Paystack
        $url = "https://api.paystack.co/transaction/initialize";
        
    
        //Gather the body params
        $transaction_data = [
           "email" => $email,
           "amount" => round($realprice * 100),
           "callback_url" => "http://localhost/Yurland/verify.php",
           "metadata" => [
              "custom_fields" => [
                [
                    "display_name" => "Unique Product",
                    "variable_name" => "product",
                    "value" => $uniqueproduct
                ],
    
                [
                    "display_name" => "Deducted Unit",
                    "variable_name" => "unit",
                    "value" => $deducted_unit
                ],
    
                [
                    "display_name" => "Bought Units",
                    "variable_name" => "boughtunit",
                    "value" => $boughtunit
                ],
    
                [
                    "display_name" => "Unique Person",
                    "variable_name" => "person",
                    "value" => $uniqueperson
                ],
    
                [
                    "display_name" => "Product Name",
                    "variable_name" => "productname",
                    "value" => $product_name
                ],
    
                [
                    "display_name" => "Payment Month",
                    "variable_name" => "paymonth",
                    "value" => $paymentmonth
                ],
    
                [
                    "display_name" => "Payment Day",
                    "variable_name" => "payday",
                    "value" => $paymentday
                ],
    
                [
                    "display_name" => "Payment Year",
                    "variable_name" => "payyear",
                    "value" => $paymentyear
                ],
    
                [
                    "display_name" => "Payment Time",
                    "variable_name" => "paytime",
                    "value" => $paymenttime
                ],
    
                [
                    "display_name" => "Product Location",
                    "variable_name" => "productlocation",
                    "value" => $productlocation
                ],
    
                [
                    "display_name" => "Price",
                    "variable_name" => "price",
                    "value" => round($price)
                ],
    
                [
                    "display_name" => "Product Image",
                    "variable_name" => "prodimage",
                    "value" => $image
                ],
                [
                    "display_name" => "Payment Method",
                    "variable_name" => "paymethod",
                    "value" => $paymentmethod
                ],
    
                [
                    "display_name" => "Payment Unit",
                    "variable_name" => "payunit",
                    "value" => $_GET['unit']
                ],
    
                [
                    "display_name" => "Payment Type",
                    "variable_name" => "payunit",
                    "value" => "newpayment"
                ],
    
                [
                    "display_name" => "New Price",
                    "variable_name" => "newprice",
                    "value" => round($newprice)
                ],
    
                [
                    "display_name" => "New Price",
                    "variable_name" => "newprice",
                    "value" => round($newpay)
                ],
    
                [
                    "display_name" => "Period",
                    "variable_name" => "period",
                    "value" => $period
                ],
    
                [
                    "display_name" => "Sub Period",
                    "variable_name" => "subperiod",
                    "value" => $subperiod
                ],
    
                [
                    "display_name" => "Payment Date",
                    "variable_name" => "paydate",
                    "value" => $paymentdate
                ],
    
                
                [
                    "display_name" => "Payee",
                    "variable_name" => "payee",
                    "value" => $payee
                ],
    
                [
                    "display_name" => "Agentid",
                    "variable_name" => "Agentid",
                    "value" => $agentid
                ],
    
                [
                    "display_name" => "Allocation Fee",
                    "variable_name" => "allocation fee",
                    "value" =>  $allocationfee
                ],
    
                [
                    "display_name" => "NewPay Id",
                    "variable_name" => "newpayid",
                    "value" => $newpayid
                ],
    
    
                [
                    "display_name" => "Chosen Plan",
                    "variable_name" => "chosenplan",
                    "value" => $chosenplan
                ],
    
                [
                    "display_name" => "Sub Price",
                    "variable_name" => "subprice",
                    "value" => $subprice
                ],
    
                [
                    "display_name" => "First Date",
                    "variable_name" => "First Date",
                    "value" => $firstDate
                ],
    
                [
                    "display_name" => "Increase Rate",
                    "variable_name" => "Increase Rate",
                    "value" => $increaserate
                ],
              
               
    
              ]
           ]
        ];
    
        // Generate a URL-encoded string
        $encode_transaction_data = http_build_query($transaction_data);
    
        // Open Connection to cURL
        $ch = curl_init();
    
        // Turn off Mandatory SSL checking
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        //Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
    
        // Enable data to be sent in POST arrays
        curl_setopt($ch, CURLOPT_POST, true);
    
        // Collect the posted data from above
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
        
        //Set the headers from the endpoint
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
            "cache-Control: no-cache"
        ));
    
        // Make curl return the data instead of echoing
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute cURL
        $result = curl_exec($ch);
        
        // Check for errors
        $errors = curl_error($ch);
        if($errors){
            $error = "You are not connected to the internet";
            header("Location: verify3.php?error=".$error."");
        }
    
        if($result){
        
            //echo $result;
            $transaction = json_decode($result);
          //Automatically redirect customers to the payment page
            header("Location: ".$transaction->data->authorization_url);
        }
        
        
        else {
            $error = "You are not connected to the internet";
            header("Location: verify3.php?error=".$error."");
        }
    
    
    } 
            
    
    
    if(empty($checklastpayment)){
        $landsub = $user->selectSubProduct($checklastpaid['product_id']);
       
       
        if($checklastpaid['product_plan'] == "onemonth"){
            $totalsubprice = $landsub['onemonth_percent'] / 100 * $landsub['onemonth_price'];
          } else if($checklastpaid['product_plan'] == "threemonths"){
            $totalsubprice = $landsub['threemonth_percent'] / 100 * $landsub['onemonth_price'];
          }  else if($checklastpaid['product_plan'] == "sixmonths"){
            $totalsubprice = $landsub['sixmonth_percent'] / 100 * $landsub['onemonth_price'];
          } else if($checklastpaid['product_plan'] == "twelvemonths"){
            $totalsubprice = $landsub['twelvemonth_percent'] / 100 * $landsub['onemonth_price'];
          } 
    
          else if($checklastpaid['product_plan'] == "eighteenmonths"){
            $totalsubprice = $landsub['eighteen_percent'] / 100 * $landsub['onemonth_price'];
          }
    
          $totprice = $checklastpaid['product_unit'] * $landsub['onemonth_price'];
            $price = $totprice + $totalsubprice;
            $pricepercent = 70 / 100 * round($price);
          
         
        if($checklastpaid['product_price'] < $pricepercent && !isset($_GET['remprice'])){
            $error = "Current plan is below 70% payment,please payup to qualify for another location on Subscription";
            header("Location: verify3.php?error=".$error."");
        } else { 
        $email = htmlspecialchars($selectuser['email']);
        if(!isset($_GET['remprice'])){
            if($_GET['data'] == "onemonth"){
                $realprice = $_GET['subpayment'] * $_POST['period'];
                $subprice = $_GET['subpayment'];
                $limit = $value['onemonth_period'];
                $increaserate = $value['onemonth_increaserate'];
                } else if($_GET['data'] == "threemonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['threemonth_period'];
                $increaserate = $value['threemonth_increaserate'];
                } else if($_GET['data'] == "sixmonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['sixmonth_period'];
                $increaserate = $value['sixmonth_increaserate'];
                } else if($_GET['data'] == "twelvemonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['twelvemonth_period'];
                $increaserate = $value['twelvemonth_increaserate'];
                } else if($_GET['data'] == "eighteenmonths"){
                    $realprice = $_GET['subpayment'] * $_POST['period'];
                    $subprice = $_GET['subpayment'];
                $limit = $value['eighteen_period'];
                $increaserate = $value['eighteen_increaserate'];
                }
            }
    
        $price = $_GET['tot'];
        if(isset($_GET['newpay'])){
            $newpay = $_GET['newpay'];
            $realprice = round($newpay);
        } else {
            $newpay = $realprice;
        }
       
        $newprice = $price - $realprice;
        if($newprice < 0){
            $newprice = 0;
        }
        $uniqueperson = $_GET['user'];
        $uniqueproduct = $_GET['uniqueid'];
        if(isset($_GET['remprice'])){
           $period = $_GET['period'];
           $landuse = $user->selectProductOldPayment($_GET['uniqueid'],$_GET['user'],$_GET['newpayid']);
           $subperiod = $landuse['period_num'] - $_GET['subperiod'];
           $firstDate = $landuse['increase_date'];
           if($landuse['product_plan'] == "onemonth"){
            $increaserate = $value['onemonth_increaserate'];
            } else if($landuse['product_plan'] == "threemonths"){
            $increaserate = $value['threemonth_increaserate'];
            } else if($landuse['product_plan'] == "sixmonths"){
            $increaserate = $value['sixmonth_increaserate'];
            } else if($landuse['product_plan'] == "twelvemonths"){
            $increaserate = $value['twelvemonth_increaserate'];
            } else if($landuse['product_plan'] == "eighteenmonths"){
            $increaserate = $value['eighteen_increaserate'];
            }
        } else {
            $time = $limit - intval($_POST['period']);
        $date = date("y-m-d");
        $date2 = date_create($date);
        $time2 = date_add($date2, date_interval_create_from_date_string("".$time." days"));
        $period = date_format($time2, "M-d-Y");
        $subperiod = $limit - intval($_POST['period']);
        $chosenplan = $_GET['data'];
        $firstDate = $_POST['planindicator'];
        }
        
        $product_name = $value['product_name'];
        $product_desc = $value['product_description'];
        $allocationfee = $value['allocation_fee'];
        
    
        if(isset($_GET['remunit'])){
            $deducted_unit = $value['product_unit'];
        }else {
            $deducted_unit = $value['product_unit'] - $_GET['unit'];
        }
           
        if(isset($_GET['remunit'])){
            $boughtunit = $value['bought_units'];
        }else {
            $boughtunit = $_GET['unit']  + $value['bought_units'];
        }
    
       
        $productlocation = $value['product_location'];
        $image = $value['product_image'];
        $paymentmonth = date("M");
        $paymentday = date("d");
        $paymentyear = date("Y");
        $paymenttime = date("h:i a");
        $paymentdate = date("M-d-Y");
        $paymentmethod = "NewPayment";
       
        if(isset($_SESSION['uniqueagent_id'])){
            $payee = $selectagent['agent_name'];
            $agentid = $selectagent['uniqueagent_id'];
        } 
    
        if(isset($_SESSION['uniquesubadmin_id'])){
            $payee = $subadmin['subadmin_name'];
            $agentid = "noagent";
        }
    
        if(isset($_SESSION['uniquesupadmin_id'])){
            $payee = $subadmin['super_adminname'];
            $agentid = "noagent";
        }
    
        $newpayid = rand();
     
       
    
    
        //Initiate Paystack
        $url = "https://api.paystack.co/transaction/initialize";
        
    
        //Gather the body params
        $transaction_data = [
           "email" => $email,
           "amount" => round($realprice * 100),
           "callback_url" => "http://localhost/Yurland/verify.php",
           "metadata" => [
              "custom_fields" => [
                [
                    "display_name" => "Unique Product",
                    "variable_name" => "product",
                    "value" => $uniqueproduct
                ],
    
                [
                    "display_name" => "Deducted Unit",
                    "variable_name" => "unit",
                    "value" => $deducted_unit
                ],
    
                [
                    "display_name" => "Bought Units",
                    "variable_name" => "boughtunit",
                    "value" => $boughtunit
                ],
    
                [
                    "display_name" => "Unique Person",
                    "variable_name" => "person",
                    "value" => $uniqueperson
                ],
    
                [
                    "display_name" => "Product Name",
                    "variable_name" => "productname",
                    "value" => $product_name
                ],
    
                [
                    "display_name" => "Payment Month",
                    "variable_name" => "paymonth",
                    "value" => $paymentmonth
                ],
    
                [
                    "display_name" => "Payment Day",
                    "variable_name" => "payday",
                    "value" => $paymentday
                ],
    
                [
                    "display_name" => "Payment Year",
                    "variable_name" => "payyear",
                    "value" => $paymentyear
                ],
    
                [
                    "display_name" => "Payment Time",
                    "variable_name" => "paytime",
                    "value" => $paymenttime
                ],
    
                [
                    "display_name" => "Product Location",
                    "variable_name" => "productlocation",
                    "value" => $productlocation
                ],
    
                [
                    "display_name" => "Price",
                    "variable_name" => "price",
                    "value" => round($price)
                ],
    
                [
                    "display_name" => "Product Image",
                    "variable_name" => "prodimage",
                    "value" => $image
                ],
                [
                    "display_name" => "Payment Method",
                    "variable_name" => "paymethod",
                    "value" => $paymentmethod
                ],
    
                [
                    "display_name" => "Payment Unit",
                    "variable_name" => "payunit",
                    "value" => $_GET['unit']
                ],
    
                [
                    "display_name" => "Payment Type",
                    "variable_name" => "payunit",
                    "value" => "newpayment"
                ],
    
                [
                    "display_name" => "New Price",
                    "variable_name" => "newprice",
                    "value" => round($newprice)
                ],
    
                [
                    "display_name" => "New Price",
                    "variable_name" => "newprice",
                    "value" => round($newpay)
                ],
    
                [
                    "display_name" => "Period",
                    "variable_name" => "period",
                    "value" => $period
                ],
    
                [
                    "display_name" => "Sub Period",
                    "variable_name" => "subperiod",
                    "value" => $subperiod
                ],
    
                [
                    "display_name" => "Payment Date",
                    "variable_name" => "paydate",
                    "value" => $paymentdate
                ],
    
                
                [
                    "display_name" => "Payee",
                    "variable_name" => "payee",
                    "value" => $payee
                ],
    
                [
                    "display_name" => "Agentid",
                    "variable_name" => "Agentid",
                    "value" => $agentid
                ],
    
                [
                    "display_name" => "Allocation Fee",
                    "variable_name" => "allocation fee",
                    "value" =>  $allocationfee
                ],
    
                [
                    "display_name" => "NewPay Id",
                    "variable_name" => "newpayid",
                    "value" => $newpayid
                ],
    
    
                [
                    "display_name" => "Chosen Plan",
                    "variable_name" => "chosenplan",
                    "value" => $chosenplan
                ],
    
                [
                    "display_name" => "Sub Price",
                    "variable_name" => "subprice",
                    "value" => $subprice
                ],
              
                [
                    "display_name" => "First Date",
                    "variable_name" => "First Date",
                    "value" => $firstDate
                ],
    
                [
                    "display_name" => "Increase Rate",
                    "variable_name" => "Increase Rate",
                    "value" => $increaserate
                ],
               
    
              ]
           ]
        ];
    
        // Generate a URL-encoded string
        $encode_transaction_data = http_build_query($transaction_data);
    
        // Open Connection to cURL
        $ch = curl_init();
    
        // Turn off Mandatory SSL checking
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
        //Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
    
        // Enable data to be sent in POST arrays
        curl_setopt($ch, CURLOPT_POST, true);
    
        // Collect the posted data from above
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encode_transaction_data);
        
        //Set the headers from the endpoint
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "authorization: Bearer sk_test_f573634d7c3451fe37a335d9bc66bf969cdbe1e4",
            "cache-Control: no-cache"
        ));
    
        // Make curl return the data instead of echoing
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Execute cURL
        $result = curl_exec($ch);
        
        // Check for errors
        $errors = curl_error($ch);
        if($errors){
            $error = "You are not connected to the internet";
            header("Location: verify3.php?error=".$error."");
        }
    
        if($result){
        
            //echo $result;
            $transaction = json_decode($result);
          //Automatically redirect customers to the payment page
            header("Location: ".$transaction->data->authorization_url);
        }
        
        
        else {
            $error = "You are not connected to the internet";
            header("Location: verify3.php?error=".$error."");
        }
    
    }
    
    
    }
            }
    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="images/logo.svg" />

    <link rel="stylesheet" href="css/index.css" />
    <title><?php echo MY_APP_NAME;?></title>
    <style>
    body {
        height: 70vh !important;
    }



    .select-box {
        border: 1px solid #808080;
        border-radius: 8px;
        width: 60%;
        margin-bottom: 1em;
    }

    @media only screen and (max-width: 1000px) {
        .btn-container .estate_page_button {
            width: 300px;
        }

        .select-box {
            border: 1px solid #808080;
            border-radius: 8px;
            width: 90%;
            margin-bottom: 1em;
        }
    }

    .input-div input {
        width: 20em !important;
    }

    .land-location p {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        color: var(--inactive-grey);
    }

    @media only screen and (max-width: 1300px) {
        .footerdiv {
            display: none;
        }

        .estate_page_button {
            margin-top: 3em;
        }
    }
    </style>
</head>

<body class="profile-body">
    <!-- Header -->
    <header class="signup">
        <?php if(isset($_SESSION['uniqueagent_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniqueagent_id'])){?>
            <a href="agentprofile.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
            <a href="subadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>

        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>



        <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
        <div class="logo">
            <?php if(isset($_SESSION['uniquesupadmin_id'])){?>
            <a href="superadmin.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php } else {?>
            <a href="index.php"><img src="images/logo.svg" alt="Logo" /></a>
            <?php }?>
        </div>
        <?php }?>


    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>New Payment</p>
    </div>



    <div class="image-desc">
        <img src="landimage/<?php echo $value['product_image']; ?>" alt="" />
    </div>

    <div class="price-desc">
        <div>
            <div class="land-name">
                <p><span>Estate Name:&nbsp;</span><?php echo $value['product_name'];?></p>
            </div>
            <div class="land-location">
                <p><span>Estate Location:&nbsp;</span><?php echo $value['product_location'];?>

                </p>
            </div>
            <?php if(!isset($_GET['remprice'])){?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Chosen Plan:&nbsp;</span><?php echo $_GET['data'];?></p>
            </div>
            <?php }?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Unit:&nbsp;</span><?php echo $_GET['unit'];?></p>
            </div>
            <div class="land-location">
                <p><span>Total Cost: &#8358;</span><?php 
                $totalcost =  $_GET['tot'];
                if($totalcost > 999 || $totalcost > 9999 || $totalcost > 99999 || $totalcost > 999999){
                    echo number_format(round($totalcost));
                    } else {
                        echo round($totalcost);
                    }
                ?></p>
            </div>
        </div>


        <form action="" method="POST">
            <?php if(isset($_GET['remprice'])){  ?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Amount Due Today: &#8358;<?php if(isset($_GET['newpay'])){
                            $cost = round($_GET['newpay']);
                            if($cost > 999 || $cost > 9999 || $cost > 99999 || $cost > 999999){
                                echo number_format(round($cost));
                                } else {
                                    echo round($cost);
                                }
                        }?></label>
            </div>
            <?php   } else {?>
            <?php if($_GET['data'] == "onemonth"){?>
            <div class="input-div">
                <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                $dailycost =$_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                <input type="number" id="dayno" name="dayno" value="<?php echo $value['onemonth_period'];?>"
                    style="display: none;" />
                <!-- <input type="number" id="day" value="" /> -->
            </div>
            <?php }?>


            <?php if($_GET['data'] == "threemonths"){?>
            <div class="input-div">
                <div class="input-div">
                    <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                      $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                    <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                    <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                    <input type="number" id="dayno" name="dayno" value="<?php echo $value['threemonth_period'];?>"
                        style="display: none;" />
                </div>
                <?php }?>

                <?php if($_GET['data'] == "sixmonths"){?>
                <div class="input-div">
                    <div class="input-div">
                        <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php
                          $dailycost =$_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                        <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                        <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                        <input type="number" id="dayno" name="dayno" value="<?php echo $value['sixmonth_period'];?>"
                            style="display: none;" />
                    </div>
                    <?php }?>

                    <?php if($_GET['data'] == "twelvemonths"){?>
                    <div class="input-div">
                        <div class="input-div">
                            <label for="day" style="width: 20em; padding-bottom: 3em;">Daily Amount: &#8358;<?php 
                             $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                }  else {
                    echo round($dailycost);
                }
                ?></label>
                            <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?> style="display: none;">
                            <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                            <input type="number" id="dayno" name="dayno"
                                value="<?php echo $value['twelvemonth_period'];?>" style="display: none;" />
                        </div>
                        <?php }?>

                        <?php if($_GET['data'] == "eighteenmonths"){?>
                        <div class="input-div">
                            <div class="input-div" style="width: 20em; padding-bottom: 3em;">
                                <label for="day">Daily Amount: &#8358;<?php
                                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></label>
                                <input type="hidden" id="dailyprice" value=<?php echo $dailycost;?>
                                    style="display: none;">
                                <label style="width: 15em;">Amount Due Today: &#8358;<span id="totalprice"><?php
                $dailycost = $_GET['subpayment'];
                if($dailycost > 999 || $dailycost > 9999 || $dailycost > 99999 || $dailycost > 999999){
                echo number_format(round($dailycost));
                } else {
                    echo round($dailycost);
                }
                ?></span></label>
                                <input type="number" id="dayno" name="dayno"
                                    value="<?php echo $value['eighteen_period'];?>" style="display: none;" />
                            </div>
                            <?php } }?>

                            <?php if(!isset($_GET['remprice'])){?>
                            <div class="input-div">
                                <input type="number" style="margin-bottom: 2em;"
                                    placeholder="Input number of days you want to pay for" value="1" id="period"
                                    name="period" pattern="[0-9]"
                                    onkeydown="if(event.key==='.'){event.preventDefault();}"
                                    onpaste="let pasteData = event.clipboardData.getData('text'); if(pasteData){pasteData.replace(/[^0-9]*/g,'');} "
                                    oninput="this.value=(parseInt(this.value)||'')" />

                            </div>
                            <?php }?>
                            <input type="hidden" name="planindicator" value="" id="plan">


                            <?php if(isset($_SESSION['uniquesubadmin_id'])){?>

                            <div class="payment-plan">
                                <p>Choose payment method</p>
                                <label class="radio" for="online">
                                    <input type="radio" name="payment" id="online" value="online payment" />
                                    <span></span>
                                    <p>Online</p>
                                </label>

                                <label class="radio" fo="offline">
                                    <input type="radio" name="payment" id="offline" value="offline payment" />
                                    <span></span>
                                    <p>Offline</p>
                                </label>
                            </div>
                            <!-- <div class="value" style="visibility: hidden"></div> -->



                            <?php }?>
                            <div class="btn-container">
                                <a href=""><button class="estate_page_button" type="submit"
                                        name="submit">Pay</button></a>
                            </div>
        </form>

        <?php }}?>

        <script src="js/main.js"></script>
        <script>
        const params = new URLSearchParams(window.location.search)

        let planindicator = document.querySelector('#plan');

        var date = new Date();

        const plan = params.get('data')
        if (plan == "onemonth") {
            var firstDay = new Date(date.getFullYear(), date.getMonth() + 1, 1);
            let firstDate = `${firstDay.toLocaleString('default', {
                                        month: 'short'
                                    })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
            planindicator.value = firstDate;
        } else if (plan == "threemonths") {
            var firstDay = new Date(date.getFullYear(), date.getMonth() + 3, 1);
            let firstDate = `${firstDay.toLocaleString('default', {
                                        month: 'short'
                                    })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
            planindicator.value = firstDate;
        } else if (plan == "sixmonths") {
            var firstDay = new Date(date.getFullYear(), date.getMonth() + 6, 1);
            let firstDate = `${firstDay.toLocaleString('default', {
                                        month: 'short'
                                    })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
            planindicator.value = firstDate;
        } else if (plan == "twelvemonths") {
            var firstDay = new Date(date.getFullYear(), date.getMonth() + 12, 1);
            let firstDate = `${firstDay.toLocaleString('default', {
                                        month: 'short'
                                    })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
            planindicator.value = firstDate;
        } else if (plan == "eighteenmonths") {
            var firstDay = new Date(date.getFullYear(), date.getMonth() + 18, 1);
            let firstDate = `${firstDay.toLocaleString('default', {
                                        month: 'short'
                                    })}-${firstDay.getDate()}-${firstDay.getFullYear()}`;
            planindicator.value = firstDate;
        }



        let inputprice = document.querySelector('#period');
        let dailyprice = document.querySelector('#dailyprice');

        inputprice.oninput = () => {
            if (inputprice.value != "") {
                document.querySelector('#totalprice').innerHTML = new Intl.NumberFormat().format(parseInt(inputprice
                    .value) * Math.round(dailyprice.value));
            } else {
                document.querySelector('#totalprice').innerHTML = new Intl.NumberFormat().format(Math.round(
                    dailyprice
                    .value));
            }

        }
        </script>
</body>

</html>