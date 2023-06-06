<?php 
include "projectlog.php";
$user = new User;
$dbcon = mysqli_connect("localhost","root","","land_estate");
if ($dbcon->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    $output = "";
  
    //$allpayusers = $user->selectAllHistory2($_POST['searchproduct3']);
    $limit = 35;
    $limit2 = $_POST['searchproduct3'];
    $sql = "SELECT * FROM land_history WHERE payment_id > '{$limit2}'  LIMIT $limit ";
    $result = $dbcon->query($sql);

    if($result->num_rows > 0){
        while($data = $result->fetch_assoc()){
         $user = $_GET['user'];
         $unique = $_GET['unique'];
    
       
            if($data['sub_status'] == "Failed"){
                if($data['payment_mode'] == "Offline"){
                    if($data['offline_status'] == ""){
                        $outputmode = '<p
                        style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                        Offline: Approved</p>';
                    } else {
                        $outputmode = ' <p
                        style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                        Offline: '.$data['offline_status'].'</p>';
                    }
                    $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
                <div class="radius">
                    <img src="landimage/'.$data['product_image'].'" alt="">
                </div>
                <div class="details">
                    <p class="pname">'.$data['product_name'].'</p>
                    <div class="inner-detail">
                        <div class="date" style="font-size: 14px;">
                            <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                        </div>
                    </div>
                  '.$outputmode.'
                </div> ';
                } else {
                    $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
                    <div class="radius">
                        <img src="landimage/'.$data['product_image'].'" alt="">
                    </div>
                    <div class="details">
                        <p class="pname">'.$data['product_name'].'</p>
                        <div class="inner-detail">
                            <div class="date" style="font-size: 14px;">
                                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                            </div>
                        </div>
                    </div> ';
                }
          
    
                if($data['product_unit'] == "1"){
                $unit = $data['product_unit']." Unit";
                } else {
                $unit = $data['product_unit']." Units";
                }
                $output2 = '
                <div class="price-detail detail3">
                    '.$unit.'
                </div>
                <div class="price-detail detail3">
                    '.$data['payment_method'].'</div> ';
    
    
                if($data['delete_status'] == "Deleted"){

                $name = $data['product_id'].$data['payment_id'];
    
                $output3 = '<form action="" class="restore-form" method="POST">
                    <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
                        style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
                </form>
            </div>
        ';
    
        $output4 = "";
        $output5 = "";
        if(isset($_POST["restorel".$name])){
        $insertupdate =
        $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);
    
        $deletedp = "restorel";
        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    
    
        }
        } else {
    
        $unitprice = $data['product_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $amount = number_format($unitprice);
        } else {
        $amount = round($unitprice);
        }
    
    
        if($user == "subadmin"){
        $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
        $result3 = $dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['subadmin_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }
    
        if($user == "superadmin"){
        $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
        $result3 = $dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['super_adminname']){
        $payeename = "You";
        } else 
        $payeename = $data['payee'];
        }
        }
    
        $output3 = "";
        $output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
            <span style="font-size: 12px;">(Failed)</span>
            <div class="payee">
                <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                    '.$payeename.'
                </p>
            </div>';
    
    
    
            $name = $data['product_id'].$data['payment_id'];
    
            $output5 = '<form action="" class="deletep-form" method="POST">
                <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                    style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
            </form>
        </div>
        ';
        if(isset($_POST["deletel".$name])){
        $insertupdate =
        $user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);
    
        $deletedp = "deletedl";
        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
        }
        
        $output .= "$output1$output2$output3$output4$output5";
        } else {
            if($data['payment_mode'] == "Offline"){
                if($data['offline_status'] == ""){
                    $outputmode = '<p
                    style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                    Offline: Approved</p>';
                } else {
                    $outputmode = ' <p
                    style="color: #7e252b; font-size: 12px; display:flex; align-items:center; justify-content:center; border-radius: 25px; border: 2px solid #7e252b; padding: 0 5px;">
                    Offline: '.$data['offline_status'].'</p>';
                }
                $output1 = ' <div class="transaction-details">
                <div class="radius">
                    <img src="landimage/'.$data['product_image'].'" alt="">
                </div>
                <div class="details">
                    <p class="pname">'.$data['product_name'].'</p>
                    <div class="inner-detail">
                        <div class="date" style="font-size: 14px;">
                            <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                        </div>
                    </div>
                    '.$outputmode.'
                </div> ';
            } else {
                $output1 = ' <div class="transaction-details">
                <div class="radius">
                    <img src="landimage/'.$data['product_image'].'" alt="">
                </div>
                <div class="details">
                    <p class="pname">'.$data['product_name'].'</p>
                    <div class="inner-detail">
                        <div class="date" style="font-size: 14px;">
                            <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                        </div>
                    </div>
                </div> ';
            }
       
    
            if($data['product_unit'] == "1"){
            $unit = $data['product_unit']." Unit";
            } else {
            $unit = $data['product_unit']." Units";
    
            $output2 = '
            <div class="price-detail detail3">
                '.$unit.'
            </div>
            <div class="price-detail detail3">'.$data['payment_method'].'</div> ';
    
    
            if($data['delete_status'] == "Deleted"){
    
            $name = $data['product_id'].$data['payment_id'];
    
            $output3 = '<form action="" class="restore-form" method="POST">
                <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
                    style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
            </form>
        </div>
        <div>';
    
            $output4 = "";
            $output5 = "";
    
    
            if(isset($_POST["restorel".$name])){
            $insertupdate =
            $user->updateLandHistory4(data['product_id'],data['payment_id'],data['payment_method'],data['newpay_id']);
    
            $deletedp = "restorel";
            header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
            }
            } else {
            $unitprice = $data['product_price'];
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
            $amount = number_format($unitprice);
            } else {
            $amount = round($unitprice);
            }
    
    
            if($user == "subadmin"){
            $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
            $result3 = $dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['subadmin_name']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
            }
    
            if($user == "superadmin"){
            $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
            $result3 = $dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['super_adminname']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
            }
    
            $output3 = "";
    
            $output4 = '<div class="price-detail">&#8358;'.$amount.'
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        '.$payeename.'
                    </p>
                </div>';
    
    
    
                $name = $data['product_id'].$data['payment_id'];
    
                $output5 = '<form action="" class="deletep-form" method="POST">
                    <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                        style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
                </form>
            </div>
        </div>
        ';
    
        if(isset($_POST["deletel".$name])){
        $insertupdate =
        $user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);
    
        $deletedp = "deletedl";
        header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
        }
        }
        $output .= "$output1$output2$output3$output4$output5";
        }
   }
}
} else {
    $output .= '<div class="success" >
    <img src="images/asset_success.svg" alt="" style="width: 300px; height: 300px;"/>
    <p>These transactions do not exist!</p>
</div>';
}

echo $output;