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
            $_SESSION['unique_id'] = $uniqueid;
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





 }

 ?>