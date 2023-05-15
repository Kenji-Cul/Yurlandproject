<?php
include_once "projectlog.php";
include_once "xlsx.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$excel = SimpleXLSX::parse($_FILES['image']['tmp_name']);

//print_r($excel->rows());
$i = 0;
 $customeridarray = [];
        $earningidarray = [];
        $earneridarray = [];
         $paidearningsarray = [];
         $balanceearningsarray = [];
         $amountearnedarray = [];
print_r($excel->sheetName(1));
foreach ($excel->rows() as $key => $row) {
  //print_r($row);
  $q = "";
  
  if($i == 0){

  } else {

       array_push($customeridarray,$row[2]);
         array_push($earningidarray,$row[0]);
         array_push($earneridarray,$row[3]);
            array_push($paidearningsarray,$row[8]);
          array_push($balanceearningsarray,$row[9]);
          array_push($amountearnedarray,$row[7]);
   
 
  }

  $i++;
} 





   array_map(function($data1, $data2, $data3, $data4, $data5,$data6) {
              
    
    $int1 = intval($data6);
    $int2 = intval($data4);
    $int3 = intval($data3);

    if($int1 == $int2 + $int3){
$user = new User;
$uploadexcel = $user->uploadExcel($data1,$data2,$data3,$data4,$data5);
    } else {
      echo "BadUpdate";
    }
            }, $customeridarray, $earneridarray,$paidearningsarray,$balanceearningsarray,$earningidarray,$amountearnedarray);
          
                  
}