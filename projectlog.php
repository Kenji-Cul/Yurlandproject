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

     function createAgent($agentname,$agent_password,$referralid,$earningpercent){
        $uniqueid = rand();
        $pwd = password_hash($agent_password,PASSWORD_DEFAULT);
          $sql = "INSERT INTO agent_table(unique_id,agent_name,agent_password,referral_id,earning_percentage) VALUES('{$uniqueid}','{$agentname}','{$pwd}','{$referralid}','{$earningpercent}')";
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


     function createSuperAdmin($adminname,$adminpassword){
        $pwd = password_hash($adminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO super_admin(unique_id,super_adminname,super_adminpassword) VALUES('{$uniqueid}','{$adminname}','{$pwd}')";
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


     function createSubAdmin($subadminname,$subadminpassword){
        $pwd = password_hash($subadminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO sub_admin(unique_id,subadmin_name,subadmin_password) VALUES('{$uniqueid}','{$subadminname}','{$pwd}')";
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

     
     function createUser($firstname, $lastname, $email, $phonenum,$password){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $sql = "INSERT INTO user(unique_id,first_name,last_name,email,phone_number,user_password) VALUES('{$uniqueid}','{$firstname}', '{$lastname}', '{$email}', '{$phonenum}', '{$pwd}')";
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

    function agentLogin($name){
        $sql = "SELECT * FROM agent_table WHERE agent_name= '{$name}'";
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