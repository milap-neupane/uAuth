<?php
  
  class User{

    # Method to get the user from the db
    public function get_info(user_name, password){
      $row = mysql_fetch_assoc(mysql_query("SELECT id,usr FROM members WHERE usr='{user_name}' AND pass='".md5(password)."'"));
    }

    #Method to create a new user
    public function new(){

    }

    #Method to logout the user
    public function logout(){
      $_SESSION = array();
      session_destroy();
    }

    public function is_logged_in_without_remember(){
      $_SESSION['id'] && !isset($_COOKIE['Remember']) && !$_SESSION['rememberMe']
    }

    #Method to check if the user is exist in the system
    public function set_login_session(){
      $row = self.get_user();
      if($row['usr']){
        $_SESSION['usr']=$row['usr'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['rememberMe'] = $_POST['rememberMe'];

        setcookie('Remember',$_POST['rememberMe']);

      }
    }

  }

?>