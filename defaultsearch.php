<?php 
include "projectlog.php";
$user = new User;
   
    $lastsevendays = date('M-d-Y', strtotime('today - '.$_POST['searchproduct'].' days'));
    $today = date('M-d-Y', strtotime('today'));
    $allpayusers = $user->selectAllPayment();

    $output = "";
   $default = [];
    foreach($allpayusers as $key => $value){
        if($value['payment_date'] == $lastsevendays){
         
          array_push($default,$value['customer_id']);
        }}

        $default2 = array_unique($default);
        for ($i=0; $i < count($default2); $i++) { 
            
        $lastpaiduser = $user->selectUser($default2[$i]);

        


          
        if(!empty($lastpaiduser)){
                $output1 = '<div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($lastpaiduser['photo'])){
                       $output2 = '<img src="profileimage/'.$lastpaiduser['photo'].'" alt="profile image" />';
}
if(empty($lastpaiduser['photo'])){
$output2 = '<div class="empty-img">
    <i class="ri-user-fill"></i>
</div> ';
}
 $output3 = '</div>
<div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$lastpaiduser['first_name'].'</span>&nbsp;<span>'.$lastpaiduser['last_name'].'</span>
</p>
<span>'.$lastpaiduser['email'].'</span>
</div>
<a href="customerprofileinfo.php?unique='.$lastpaiduser['unique_id'].'&real=91838JDFOJOEI939"
style="color: #808080;"><i class="ri-arrow-right-s-line"></i></a>
</div> ';

$output .= ''.$output1.''.$output2.''.$output3.'';

        } else {
            $output = '<div class="success">
            <img src="images/asset_success.svg" alt="" />
            <p>There are no default customers yet!</p>
        </div>';
        }

    }

    if(empty($lastpaiduser)){
        $output = '<div class="success">
        <img src="images/asset_success.svg" alt="" />
        <p>There are no default customers yet!</p>
    </div>';
    }
echo $output;