<?php  $last = $user->selectLastPayment($_SESSION['unique_id']);
   if(!empty($last)){
                    $first = $user->selectBalPayment($_SESSION['unique_id'],$last['product_id']); ?>
                
      <div class="subscribed-land">
            <?php if($last['payment_status'] == "Deleted"){?>
            <div class="deleted-div">
                <div class="price">Deleted</div>
            </div>
            <?php }?>
            <div class="subscribed-img">
                <img src="landimage/<?php echo $last['product_image'];?>" alt="estate image" />
                <div class="ellipse">
                    <i class="ri-heart-fill"></i>
                </div>
            </div>
            <div class="subscribed-details">
                <div>
                    <p class="land-name"><?php echo $last['product_name'];?></p>
                    <p class="land-location"><?php echo $last['product_location'];?></p>
                </div>
                
                <div class="price">
          
           <input type="hidden" id="date" value="<?php echo $value['sub_period'];?>"/>
               <a href="estateinfo.php?id=<?php echo $last['product_id'];?>&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&payment=newpayment&keyref=09123454954848kdksuuejwej&remprice=<?php echo $last['balance'];?>"  style="color: #7e252b;">Make Payment</a>
       
            
          
                           
            </div>
            
               <script>
                let dateInput = document.querySelector('#date');
                var countDownDate = new Date(dateInput.value).getTime();
                var now = new Date().getTime();
                var timeleft = countDownDate - now;
               
                var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
                console.log(timeleft);
                if(timeleft < 0){

                }
               </script>
               
            </div>
            <div class="subscribed-details"
                style="flex-direction: column; align-items: center; justify-content: center; gap: 1em;">
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%; ">
                    <p class="amountpaid"><span>Amount
                            Paid:</span>&nbsp;&#8358;<span><?php 
                            if(!empty($first)){
                                foreach($first as $key => $value){
                                    $unitprice = $value;
                                }
                            } else {
                                $unitprice = $value['product_price'];
                            }
            
             if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                               echo number_format($unitprice);
                             } 
            ?></span></p>
                    <p class="balance"><span>Balance:</span>&nbsp;&#8358;<span><?php 
                        $unprice = $last['balance'];
                        if($unprice > 999 || $unprice > 9999 || $unprice > 99999 || $unprice > 999999){
                                          echo number_format($unprice);
                                        } 
                                        if($unprice == "0"){
                                            echo "0";
                                        }
                    ?></span></p>
                </div>
                <div class="balance" style="display: flex;
                align-items: center; justify-content center; gap: 3em; text-align: center; width: 100%;">
                    <p class="amountpaid"><span>Start
                            Date:</span>&nbsp;<span><?php echo $last['payment_day'];?></span>-<span><?php echo $last['payment_month'];?></span>-<span><?php echo $last['payment_year'];?></span>
                    </p>
                    <?php if($last['payment_method'] == "Subscription" || $last['payment_status'] == "Payed"){  ?>
                    <p class="balance"><span>Expected End Date:</span>&nbsp;<span><?php echo $last['sub_period']?></span></p>
                    <?php }?>
                </div>
            </div>
        </div>

       
    <?php }?>

