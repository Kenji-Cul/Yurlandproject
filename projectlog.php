<?php 

/**
 * Author : Teibo Gideon
 * Program : Yurland Website
 * Date : Nov 5,2022
 */

include "signconstant.php";

 class User{
    var $username;
    var $useremail;
    var $dbcon;

    function __construct(){
        $this->dbcon = new MySqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
        if($this->dbcon->connect_error){
            die("Connection Failed: ".$this->dbcon->connect_error);
        } else{
           //echo "Connected Successfully";
        }
     }

     function createAgent($agentname,$agent_password,$referralid,$earningpercent, $email){
        $uniqueid = rand();
        $pwd = password_hash($agent_password,PASSWORD_DEFAULT);
          $sql = "INSERT INTO agent_table(uniqueagent_id,agent_name, agent_email,agent_password,referral_id,earning_percentage) VALUES('{$uniqueid}','{$agentname}','{$email}','{$pwd}','{$referralid}','{$earningpercent}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['uniqueagent_id'] = $uniqueid;
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }


     function createSuperAdmin($adminname,$adminpassword,$adminemail){
        $pwd = password_hash($adminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO super_admin(unique_id,super_adminname,super_adminpassword,super_adminemail) VALUES('{$uniqueid}','{$adminname}','{$pwd}','{$adminemail}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['uniquesupadmin_id'] = $uniqueid;
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }


     function createSubAdmin($subadminname,$subadminpassword, $subadminemail, $subadminnum){
        $pwd = password_hash($subadminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO sub_admin(unique_id,subadmin_name,subadmin_password,subadmin_email,subadmin_num) VALUES('{$uniqueid}','{$subadminname}','{$pwd}','{$subadminemail}','{$subadminnum}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['uniquesubadmin_id'] = $uniqueid;
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }

     
     function createUser($firstname, $lastname, $email, $phonenum,$password,$referral){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $sql = "INSERT INTO user(unique_id,first_name,last_name,email,phone_number,user_password,personal_ref) VALUES('{$uniqueid}','{$firstname}', '{$lastname}', '{$email}', '{$phonenum}', '{$pwd}','{$referral}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }


     function updateUser($email,$password,$referralid, $personalref){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $sql = "UPDATE user SET unique_id='{$uniqueid}',user_password='{$pwd}', personal_ref='{$personalref}' WHERE email='{$email}' AND referral_id='{$referralid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function updateUserInfo($firstname,$lastname,$email,$unique,$phonenum,$earning){
        $sql = "UPDATE user SET first_name='{$firstname}', last_name='{$lastname}', email='{$email}',phone_number='{$phonenum}',earning_percentage='{$earning}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function updateUserForReferral($firstname, $lastname, $email, $phonenum,$password,$referralid,$personalref){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $sql = "INSERT INTO user(first_name,last_name,phone_number,unique_id,user_password,email,referral_id, personal_ref) VALUES('{$firstname}','{$lastname}','{$phonenum}','{$uniqueid}','{$pwd}','{$email}','{$referralid}','{$personalref}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }


     function createReferralUser($referral, $email,$firstname,$lastname,$phone_num){
        $sql = "INSERT INTO user(referral_id,email,first_name,last_name,phone_number) VALUES('{$referral}','{$email}','{$firstname}','{$lastname}','{$phone_num}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function checkReferral($referral, $email){
        $sql = "SELECT * FROM user WHERE email = '{$email}' AND referral_id = '{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
     }


   

     


     function checkEmailAddress($email){
        $sql = "SELECT * FROM user WHERE email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }

      function checkAgentEmailAddress($email){
        $sql = "SELECT * FROM agent_table WHERE agent_email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }


      function checkSubadminEmailAddress($email){
        $sql = "SELECT * FROM sub_admin WHERE subadmin_email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }

      function checkSuperadminEmailAddress($email){
        $sql = "SELECT * FROM super_admin WHERE super_adminemail ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }




      function selectUser($uniqueid){
        $sql = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectReferralUser($referralid){
        $sql = "SELECT * FROM user WHERE personal_ref = '{$referralid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    

    function selectReferralAgent($referralid){
        $sql = "SELECT * FROM agent_table WHERE referral_id = '{$referralid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectAgent($uniqueid){
        $sql = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentCustomer($uniqueid){
        $sql = "SELECT * FROM user WHERE referral_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


    function selectSubadmin($uniqueid){
        $sql = "SELECT * FROM sub_admin WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSupadmin($uniqueid){
        $sql = "SELECT * FROM super_admin WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function login($email){
        $sql = "SELECT * FROM user WHERE email= '{$email}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function agentLogin($email){
        $sql = "SELECT * FROM agent_table WHERE agent_email= '{$email}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function subAdminLogin($name){
        $sql = "SELECT * FROM sub_admin WHERE subadmin_email= '{$name}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function superAdminLogin($name){
        $sql = "SELECT * FROM super_admin WHERE super_adminemail= '{$name}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }


    function insertNextOfKin($nextofkinfirstname,$nextofkinlastname, $nextofkinemail, $nexofkinaddress, $nextofkinphone,$nextofkinrelation, $uniqueid){
         $sql = "UPDATE user SET nextofkin_firstname='{$nextofkinfirstname}', nextofkin_lastname='{$nextofkinlastname}', nextofkin_email='{$nextofkinemail}' , nextofkin_address='{$nexofkinaddress}', nextofkin_phone='{$nextofkinphone}', nextofkin_relation='{$nextofkinrelation}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertUserAddress($homeaddress,$uniqueid){
        $sql = "UPDATE user SET home_address = '{$homeaddress}' WHERE unique_id='{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function updatePhoneNum($phonenum,$uniqueid){
        $sql = "UPDATE user SET phone_number = '{$phonenum}' WHERE unique_id='{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }


   
      

    function insertDocuments($uniqueid,$nin){
        if(isset($_FILES['passport'])){
        $filename = $_FILES['passport']['name'];
        $filesize = $_FILES['passport']['size'];
        $filetype = $_FILES['passport']['type'];
        $file_error = $_FILES['passport']['error'];
        $filetmp = $_FILES['passport']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
        }
    
        if($filesize > 2097152){
            $error = "File Should be 2mb or less";
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
        }

       
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../userdocuments/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE user SET passport='{$newfilename}', nin='{$nin}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
            if(isset($error)){
                echo $error;
            }
              }
     } 
    }
    }


    function insertLicense($uniqueid){
        if(isset($_FILES['license'])){
        $filename = $_FILES['license']['name'];
        $filesize = $_FILES['license']['size'];
        $filetype = $_FILES['license']['type'];
        $file_error = $_FILES['license']['error'];
        $filetmp = $_FILES['license']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("pdf");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../documents/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE user SET driver_license='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function updateUserDetails($uniqueid, $gender, $occupation, $day, $month, $year){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE user SET photo='{$newfilename}', gender='{$gender}', occupation='{$occupation}', dayof='{$day}', monthof='{$month}', yearof='{$year}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function updateAgentDetails($uniqueid, $address, $num){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE agent_table SET agent_img='{$newfilename}', home_address='{$address}', agent_num='{$num}' WHERE uniqueagent_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function updateSubadminDetails($uniqueid,$num){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE sub_admin SET subadmin_image ='{$newfilename}', subadmin_num='{$num}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function updateSupadminDetails($uniqueid){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE super_admin SET admin_image ='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function selectReferredUsers($referral){
        $sql = "SELECT COUNT(referral_id) FROM user WHERE referral_id='{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectReferredCustomer($referral){
        $sql = "SELECT COUNT(referral_id) FROM user WHERE referral_id='{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


  
    function uploadProduct($productname,$outrightprice,$productdesc,$estatefeature,$productsize,$productlocation,$onemonth,$threemonth,$sixmonth,$twelvemonth,$eighteenmonth,$uniqueid,$purpose,$unitprice,$unitnumber){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,outright_price,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,threemonth_price,sixmonth_price,twelvemonth_price,eighteen_price,purpose,product_unit,unit_price) VALUES('{$uniqueid}','{$productname}','{$outrightprice}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$threemonth}','{$sixmonth}','{$twelvemonth}','{$eighteenmonth}','{$purpose}','{$unitnumber}','{$unitprice}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function uploadOutrightProduct($productname,$outrightprice,$productdesc,$estatefeature,$productsize,$productlocation,$uniqueid,$purpose,$unitprice,$unitnumber){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,outright_price,product_image,product_description,estate_feature,product_size,product_location,purpose,product_unit,unit_price) VALUES('{$uniqueid}','{$productname}','{$outrightprice}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$purpose}','{$unitnumber}','{$unitprice}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function uploadSubProduct($productname,$productdesc,$estatefeature,$productsize,$productlocation,$onemonth,$threemonth,$sixmonth,$twelvemonth,$eighteenmonth,$uniqueid,$purpose,$unitprice,$unitnumber){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,threemonth_price,sixmonth_price,twelvemonth_price,eighteen_price,purpose,product_unit,unit_price) VALUES('{$uniqueid}','{$productname}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$threemonth}','{$sixmonth}','{$twelvemonth}','{$eighteenmonth}','{$purpose}','{$unitnumber}','{$unitprice}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function uploadOtherOptions($uniqueid){
        if(isset($_FILES['firstimage'])){
        $filename = $_FILES['firstimage']['name'];
        $filesize = $_FILES['firstimage']['size'];
        $filetype = $_FILES['firstimage']['type'];
        $file_error = $_FILES['firstimage']['error'];
        $filetmp = $_FILES['firstimage']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }

       
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }

    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE land_product SET image_one ='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }

    function selectLand(){
        $sql = "SELECT * FROM land_product";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllUsers(){
        $sql = "SELECT * FROM user";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }


    function selectAllAgents(){
        $sql = "SELECT * FROM agent_table";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectLandPrime(){
        $sql = "SELECT * FROM land_product ORDER BY rand() LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectLandImage($unique){
        $sql = "SELECT * FROM land_product WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    

    function selectSixMonthPrice(){
        $sql = "SELECT MAX(sixmonth_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectMinPrice(){
        $sql = "SELECT MIN(sixmonth_price) FROM land_product WHERE sixmonth_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectOneMonthPrice(){
        $sql = "SELECT MAX(onemonth_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectMinOneMonthPrice(){
        $sql = "SELECT MIN(onemonth_price) FROM land_product WHERE onemonth_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectLowestPrice(){
        $sql = "SELECT MIN(outright_price) FROM land_product WHERE outright_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectHighestPrice(){
        $sql = "SELECT MAX(outright_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function searchForLand($price,$location,$purpose){
        $sql = "SELECT * FROM land_product WHERE outright_price <= '{$price}' AND outright_price > 0 AND product_location = '{$location}' AND purpose = '{$purpose}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


    function insertPeriod($onemonth,$threemonth,$sixmonth,$twelvemonth,$eighteenmonth,$unique,$eighteenpercentage,$twelvepercentage,$sixpercentage,$threepercentage,$onepercentage){
        $sql = "UPDATE land_product SET onemonth_period='{$onemonth}', threemonth_period='{$threemonth}', sixmonth_period='{$sixmonth}', twelvemonth_period='{$twelvemonth}', eighteen_period='{$eighteenmonth}',onemonth_percent='{$onepercentage}',threemonth_percent='{$threepercentage}', sixmonth_percent='{$sixpercentage}',twelvemonth_percent='{$twelvepercentage}',eighteen_percent='{$eighteenpercentage}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows > 0){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function selectPeriod(){
        $sql = "SELECT * FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectUnit($unique){
        $sql = "SELECT * FROM land_product WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
           echo $row['unit_price'];
        }else{
            return $row;
        }
    }

    function updateUnit($productunit,$unique){
        $sql = "UPDATE land_product SET product_unit ='{$productunit}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method){
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function selectPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectCurrentPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' ORDER BY payment_id DESC LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectSubPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND payment_method='Subscription'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectTotal($id){
        $sql = "SELECT SUM(product_price) FROM payment WHERE customer_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectNums($user){
        $sql = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSubNum($user){
        $sql = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$user}' AND payment_method='Subscription'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function addToCart($userid,$productid){
        $sql = "INSERT INTO cart(user_id,product_id) VALUES('{$userid}','{$productid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function addAgentCart($userid,$productid){
        $sql = "INSERT INTO cart(agent_id,product_id) VALUES('{$userid}','{$productid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function selectCart($user){
        $sql = "SELECT COUNT(product_id) FROM cart WHERE user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentCart($user){
        $sql = "SELECT COUNT(product_id) FROM cart WHERE agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectCartId($userid){
        $sql = "SELECT product_id FROM cart WHERE user_id='{$userid}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectCartId2($userid){
        $sql = "SELECT product_id FROM cart WHERE agent_id='{$userid}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function DeleteCartId($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    
    function DeleteProduct($userid,$user){
        $sql = "UPDATE payment SET payment_status='Deleted' WHERE product_id='{$userid}' AND customer_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteProductP($userid,$user){
        $sql = "DELETE  FROM payment WHERE product_id='{$userid}' AND customer_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateProductStat($userid,$user){
        $sql = "UPDATE payment SET payment_status='Restored' WHERE product_id='{$userid}' AND customer_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteAgentCartId($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteCartId2($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
           //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteCartId3($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
           //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }


    function updatePassword($unique,$password){
        $sql2 = "SELECT * FROM user WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE user SET user_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    
    function updateAgentPassword($unique,$password){
        $sql2 = "SELECT * FROM agent_table WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE agent_table SET agent_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    function updateSubPassword($unique,$password){
        $sql2 = "SELECT * FROM sub_admin WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE sub_admin SET subadmin_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    function updateSuperPassword($unique,$password){
        $sql2 = "SELECT * FROM super_admin WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE super_admin SET super_adminpassword='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

   


}

?>