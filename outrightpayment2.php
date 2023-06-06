<?php 
session_start();


include "projectlog.php";
if(!isset($_GET['remprice'])){
    if(!isset($_GET['tot']) || !isset($_GET['uniqueid'])){
        header('Location: index.php');
    }
}

?>
<?php

$user = new User;
if(isset($_GET['remprice'])){
    $selectuser = $user-> selectUser($_GET['unique']);
} else {
    $selectuser = $user-> selectUser($_GET['user']);
}

if(isset($_SESSION['uniqueagent_id'])){
    $selectagent = $user->selectAgent($_SESSION['uniqueagent_id']);
    }
    if(isset($_SESSION['uniquesubadmin_id'])){
    $subadmin = $user->selectSubadmin($_SESSION['uniquesubadmin_id']);
    }

    if(isset($_SESSION['uniquesupadmin_id'])){
        $subadmin = $user->selectSupadmin($_SESSION['uniquesupadmin_id']);
        }

   
        if(isset($_GET['remprice'])){
            $landview = $user->selectLandImage($_GET['id']);
        } else {
            $landview = $user->selectLandImage($_GET['uniqueid']);
        }
   
    if(!empty($landview)){
        foreach($landview as $key => $value){ 

            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_SESSION['uniquesubadmin_id'])){
            if(isset($_POST['payment']) && !empty($_POST['payment'])){
                $plan = $_POST['payment'];
                if($plan == "offline payment"){
                    if(isset($_POST["submit"])){
                        $email = htmlspecialchars($selectuser['email']);
                        if(isset($_GET['remprice'])){
                            $price = $_GET['remprice'];
                        $realprice = round($price * 100);
                        $uniqueperson = $_GET['unique'];
                        $uniqueproduct = $_GET['id'];
                        } else {
                            $price = $_GET['tot'];
                            $realprice = round($price * 100);
                            $uniqueperson = $_GET['user'];
                            $uniqueproduct = $_GET['uniqueid'];
                        }

                        if(isset($_GET['remprice'])){
                            $deducted_unit = $value['product_unit'];
                            $boughtunit = $value['bought_units'];
                            $selectland = $user->selectPayment2($_GET['id'],$_GET['idtwo'],$uniqueperson,$paymentmethod);
                            foreach($selectland as $key => $value2){
                            $getunit = $value2['product_unit'];
                            }
                        } else {
                            $deducted_unit = $value['product_unit'] - $_GET['unit'];
                            $boughtunit = $_GET['unit'] + $value['bought_units'];
                            $getunit = $_GET['unit'];
                        }
                      
                       
                        $product_name = $value['product_name'];
                        $product_desc = $value['product_description'];
                        $allocationfee = $value['allocation_fee'];
                       
                        $productlocation = $value['product_location'];
                        $image = $value['product_image'];
                        $paymentmonth = date("M");
                        $paymentday = date("d");
                        $paymentyear = date("Y");
                        $paymenttime = date("h:i a");
                        $paymentdate = date("M-d-Y");
                        $paymentmethod = "Outright";
                        $newpayid = rand();
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

                        if(isset($_GET['remprice'])){
                            $selectland = $user->selectPayment2($_GET['id'],$_GET['idtwo'],$uniqueperson,$paymentmethod);
                            foreach($selectland as $key => $value2){
                            $balanceprice = $value2['balance'] - $_GET['remprice'];
                            $prodprice = $value2['product_price'] + $_GET['remprice'];
                              $inserthistory = $user->updatePayment3($_GET['id'],$_GET['idtwo'],$uniqueperson,$paymentmethod,$balanceprice,$prodprice);

                              $inserthistory = $user->insertOutPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$_GET['remprice'],$image,$value2['product_unit'],$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
                            }

                            $selectuser = $user->selectUser($uniqueperson);
                            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                            $executives = $user->selectAllExecutive();
                            if(!empty($executives)){
                            foreach($executives as $key => $value){
                              $earnerid = $value['unique_id'];
                        $earnee = $value['full_name'];
                        $earnedamount = $value['earning'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                              $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }
                          }
                        
                        $agentearnee = $user->selectAgent($agentid);
                        $userearnee = $user->selectUser($agentid);
                        
                        if(!empty($agentearnee)){
                        $earnerid = $agentearnee['uniqueagent_id'];
                        $earnee = $agentearnee['agent_name'];
                        $earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                        $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                        }
                        
                        if(!empty($userearnee)){
                          $earnerid = $userearnee['unique_id'];
                          $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
                          $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
                          $selectuser = $user->selectUser($uniqueperson);
                          $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                          $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                          }
                        
                          if($agentid == "noagent"){
                            $earnerid = "Yurland";
                            $earnee = "Yurland";
                            $userearnee = $user->selectUser($uniqueperson);
                            $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
                            $selectuser = $user->selectUser($uniqueperson);
                            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                            $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }

                            $filename = "";

                           

                            header("Location:successemail.php?name=".$name."&date=".$paymentdate."&amount=".$price."&estate=".$product_name."&balance='0'&payer=".$payee."&email=".$email."&mode='offline'");
                        
                        } else {

                        
                        if($_GET['unit'] % 4 == 0){
                          
                          
                           
                                $unit_added = $_GET['unit'] / 4;
                                $added_unit = $_GET['unit'] + $unit_added;
                            
                                $uniquename = rand();
                                $filename = "allocationletter".$uniquename.".pdf";

                                $selectuser = $user->selectUser($uniqueperson);
                                $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                               
                                
                                  if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                                    $allocationfee2 = number_format($allocationfee);
                                  } else {
                                    $allocationfee2 =  round($allocationfee);
                                  }
                            
                                  $balance = 0;
                                  
                                header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."&mode='offline'");
    
                                $insertpayment = $user->insertOutPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);
                            
                        
                        $executives = $user->selectAllExecutive();
                            if(!empty($executives)){
                            foreach($executives as $key => $value){
                              $earnerid = $value['unique_id'];
                        $earnee = $value['full_name'];
                        $earnedamount = $value['earning'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                              $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }
                          }
                        
                        $agentearnee = $user->selectAgent($agentid);
                        $userearnee = $user->selectUser($agentid);
                        
                        if(!empty($agentearnee)){
                        $earnerid = $agentearnee['uniqueagent_id'];
                        $earnee = $agentearnee['agent_name'];
                        $earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                        $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                        }
                        
                        if(!empty($userearnee)){
                          $earnerid = $userearnee['unique_id'];
                          $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
                          $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
                          $selectuser = $user->selectUser($uniqueperson);
                          $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                          $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                          }
                        
                          if($agentid == "noagent"){
                            $earnerid = "Yurland";
                            $earnee = "Yurland";
                            $userearnee = $user->selectUser($uniqueperson);
                            $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
                            $selectuser = $user->selectUser($uniqueperson);
                            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                            $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }
                        
                        
                            $inserthistory = $user->insertOutPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$added_unit,$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
                
                        } else {

                        
                                $uniquename = rand();
                                $filename = "allocationletter".$uniquename.".pdf";
                                $selectuser = $user->selectUser($uniqueperson);
                                $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                               
                                
                                  if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                                    $allocationfee2 = number_format($allocationfee);
                                  } else {
                                    $allocationfee2 =  round($allocationfee);
                                  }

                                  $balance = 0;

                                  header("Location: allocationletter.php?filename=".$filename."&estatename=".$product_name."&estatelocal=".$productlocation."&allocationfee=".$allocationfee2."&customer=".$name."&amount=".$price."&balance=".$balance."&payer=".$payee."&email=".$selectuser['email']."&mode='offline'");
                                  $insertpayment = $user->insertOutPayment($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$_GET['unit'],$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid);
                            
                            
                        
                            
                           $executives = $user->selectAllExecutive();
                            if(!empty($executives)){
                            foreach($executives as $key => $value){
                              $earnerid = $value['unique_id'];
                        $earnee = $value['full_name'];
                        $earnedamount = $value['earning'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                              $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }
                          }
                        
                        $agentearnee = $user->selectAgent($agentid);
                        $userearnee = $user->selectUser($agentid);
                        
                        if(!empty($agentearnee)){
                        $earnerid = $agentearnee['uniqueagent_id'];
                        $earnee = $agentearnee['agent_name'];
                        $earnedamount = $agentearnee['earning_percentage'] / 100 * $price;
                        $selectuser = $user->selectUser($uniqueperson);
                        $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                        $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                        }
                        
                        if(!empty($userearnee)){
                          $earnerid = $userearnee['unique_id'];
                          $earnee = $userearnee['first_name']." ".$userearnee['last_name'];
                          $earnedamount = $userearnee['earning_percentage'] / 100 * $price;
                          $selectuser = $user->selectUser($uniqueperson);
                          $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                          $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                          }
                        
                          if($agentid == "noagent"){
                            $earnerid = "Yurland";
                            $earnee = "Yurland";
                            $userearnee = $user->selectUser($uniqueperson);
                            $earnedamount = $userearnee['yurland_percentage'] / 100 * $price;
                            $selectuser = $user->selectUser($uniqueperson);
                            $name = $selectuser['first_name'].' '.$selectuser['last_name'];
                            $insertearning = $user->insertEarningHistory2($uniqueperson,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$price,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid,$offlinestatus,$paymentmode);
                            }
                        
                           
                               
                           $inserthistory = $user->insertOutPayHistory2($uniqueperson,$uniqueproduct,$product_name,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$_GET['unit'],$paymentmethod,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid,$offlinestatus,$paymentmode);
                            
                        
                        
                           
                        }
                    }

                        $update = $user->updateUnit($deducted_unit,$uniqueproduct,$boughtunit);
                        if(isset($_SESSION['unique_id'])){
                        $delete = $user->DeleteCartId($uniqueproduct,$_SESSION['unique_id']);
                        if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
                         // Remove the product from the shopping cart
                         unset($_SESSION['cart'][$uniqueproduct]);
                         
                     }
                        }
                     
                     if(isset($_SESSION['uniquesubadmin_id'])){
                         $delete = $user->DeleteCartId($uniqueproduct,$uniqueperson);
                         if (isset($uniqueproduct) && is_numeric($uniqueproduct) && isset($uniqueproduct) && isset($_SESSION['cart'][$uniqueproduct])) {
                          // Remove the product from the shopping cart
                          unset($_SESSION['cart'][$uniqueproduct]);
                     }
                     }
                        // header("Location: verifyoffline.php?uniqueproduct=".$uniqueproduct."&deductedunit=".$deducted_unit."&boughtunit=".$boughtunit."&uniqueperson=".$uniqueperson."&productname=".$product_name."&paymonth=".$paymentmonth."&payday=".$paymentday."&payyear=".$paymentyear."&paytime=".$paymenttime."&productlocation=".$productlocation."&price=".$price."&image=".$image."&paymethod=".$paymentmethod."&unit=".$_GET['unit']."&paytype='outrightpayment'&paydate=".$paymentdate."&payee=".$payee."&agentid=".$agentid."&allocationfee=".$allocationfee."&newpayid=".$newpayid."");
                    }
                } 
                if($plan == "online payment"){
                    $planmode = "online";
                    //echo "online payment";
                
// Integrate Paystack
if(isset($_POST["submit"])){
  
    $email = htmlspecialchars($selectuser['email']);
    if(isset($_GET['remprice'])){
        $price = $_GET['remprice'];
    $realprice = round($price * 100);
    $uniqueperson = $_GET['unique'];
    $uniqueproduct = $_GET['id'];
    } else {
        $price = $_GET['tot'];
        $realprice = round($price * 100);
        $uniqueperson = $_GET['user'];
        $uniqueproduct = $_GET['uniqueid'];
    }
  
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
    if(isset($_GET['remprice'])){
        $deducted_unit = $value['product_unit'];
        $boughtunit = $value['bought_units'];
        $selectland = $user->selectPayment2($_GET['id'],$_GET['idtwo'],$uniqueperson,$paymentmethod);
        foreach($selectland as $key => $value2){
        $getunit = $value2['product_unit'];
        }
        $paymode = "Offline";
    } else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
        $boughtunit = $_GET['unit'] + $value['bought_units'];
        $getunit = $_GET['unit'];
        $paymode = "Online";
    }
    
   
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "Outright";
    $newpayid = rand();
   
    if(isset($_GET['remprice'])){
        $newpayid2 = $_GET['idtwo'];
    } else {
        $newpayid2 = "remprice";
    }
  
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

   
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => $realprice,
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
                "value" => $price
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
                "value" => $getunit
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "outrightpayment"
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
                "variable_name" => "NewPay Id",
                "value" =>  $newpayid
            ],

            [
                "display_name" => "NewPay Id2",
                "variable_name" => "NewPay Id2",
                "value" =>  $newpayid2
            ],

            [
                "display_name" => "Pay Mode",
                "variable_name" => "Pay Mode",
                "value" =>  $paymode
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
        // var_dump($result);
    $transaction = json_decode($result);
    //Automatically redirect customers to the payment page
    header("Location: ".$transaction->data->authorization_url);
    }
   
} 
            }
        }
            }

        
    if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesupadmin_id'])){
        // Integrate Paystack
if(isset($_POST["submit"])){
    $email = htmlspecialchars($selectuser['email']);
    if(isset($_GET['remprice'])){
        $price = $_GET['remprice'];
    $realprice = round($price * 100);
    $uniqueperson = $_GET['unique'];
    $uniqueproduct = $_GET['id'];
    } else {
        $price = $_GET['tot'];
        $realprice = round($price * 100);
        $uniqueperson = $_GET['user'];
        $uniqueproduct = $_GET['uniqueid'];
    }
  
    $product_name = $value['product_name'];
    $product_desc = $value['product_description'];
    $allocationfee = $value['allocation_fee'];
    if(isset($_GET['remprice'])){
        $deducted_unit = $value['product_unit'];
        $boughtunit = $value['bought_units'];
        $selectland = $user->selectPayment2($_GET['id'],$_GET['idtwo'],$uniqueperson,$paymentmethod);
        foreach($selectland as $key => $value2){
        $getunit = $value2['product_unit'];
        }
        $paymode = "Offline";
    } else {
        $deducted_unit = $value['product_unit'] - $_GET['unit'];
        $boughtunit = $_GET['unit'] + $value['bought_units'];
        $getunit = $_GET['unit'];
        $paymode = "Online";
    }
    
    $productlocation = $value['product_location'];
    $image = $value['product_image'];
    $paymentmonth = date("M");
    $paymentday = date("d");
    $paymentyear = date("Y");
    $paymenttime = date("h:i a");
    $paymentdate = date("M-d-Y");
    $paymentmethod = "Outright";
    $newpayid = rand();
    if(isset($_GET['remprice'])){
        $newpayid2 = $_GET['idtwo'];
    } else {
        $newpayid2 = "remprice";
    }
   
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

   
   


    //Initiate Paystack
    $url = "https://api.paystack.co/transaction/initialize";
    

    //Gather the body params
    $transaction_data = [
       "email" => $email,
       "amount" => $realprice,
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
                "value" => $price
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
                "value" => $getunit
            ],

            [
                "display_name" => "Payment Type",
                "variable_name" => "payunit",
                "value" => "outrightpayment"
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
                "variable_name" => "NewPay Id",
                "value" =>  $newpayid
            ],

            [
                "display_name" => "NewPay Id2",
                "variable_name" => "NewPay Id2",
                "value" =>  $newpayid2
            ],

            [
                "display_name" => "Pay Mode",
                "variable_name" => "Pay Mode",
                "value" =>  $paymode
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
        // var_dump($result);
    $transaction = json_decode($result);
    //Automatically redirect customers to the payment page
    header("Location: ".$transaction->data->authorization_url);
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
            width: 270px;
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


    </header>

    <div class="page-title4">
        <div>
            <img src="images/orange-cart-icon.svg" alt="" />
        </div>
        <p>Outright Payment</p>
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
                <p><span>Estate Location:&nbsp;</span><?php echo $value['product_location'];?></p>
            </div>
            <?php if(!isset($_GET['remprice'])){?>
            <div class="land-location">
                <p style="text-transform: capitalize;"><span>Unit:&nbsp;</span><?php echo $_GET['unit'];?></p>
            </div>
            <?php }?>
        </div>


        <?php if(isset($_SESSION['uniqueagent_id']) || isset($_SESSION['uniquesupadmin_id'])){?>
        <form action="" method="POST">
            <div class="cost">
                <p>Total Cost:&nbsp;&nbsp;&nbsp;<span>&#8358;<?php 
                if(isset($_GET['remprice'])){
                    $unitprice = $_GET['remprice'];
                } else {
                    $unitprice = $_GET['tot'];
                }
             
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></span></p>
                <p><?php 
            
            ?></p>
            </div>

            <input type="hidden" name="deduct" id="unit-deduct" value="">


            <div class="btn-container">
                <button class="estate_page_button" type="submit" name="submit">Pay</button>
            </div>
        </form>
        <?php }?>

        <?php if(isset($_SESSION['uniquesubadmin_id'])){?>
        <form action="" method="POST">
            <div class="cost">
                <p>Total Cost:&nbsp;&nbsp;&nbsp;<span>&#8358;<?php 
            if(isset($_GET['remprice'])){
                $unitprice = $_GET['remprice'];
            } else {
                $unitprice = $_GET['tot'];
            }
         
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             }
            ?></span></p>
                <p><?php 
            
            ?></p>
            </div>

            <input type="hidden" name="deduct" id="unit-deduct" value="">
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


            <div class="btn-container">
                <input type="submit" class="estate_page_button" type="submit" name="submit" value="Pay" />

            </div>

        </form>

        <?php }?>



        <?php }}?>

        <script src="js/main.js"></script>

</body>

</html>