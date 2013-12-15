<!-- http://tutorialzine.com/2009/10/cool-login-system-php-jquery/ (backend system initally made from)-->
<?php
require 'connection.php';
require 'user.php';
  new Connection;
  // starting session 
  session_name('ulogin'); 

  // make the cookie live for 2 weeks
  session_set_cookie_params(2*7*24*60*60);

  session_start();

  $user = new User;

  $user_logged_in = $user->is_logged_in_without_remember();

  if( $user_logged_in ){
    $user->logout();
  }

  if( isset($_GET['logoff']) ){
    $user->logout();
    header("Location: ./");
    exit;
  }
  
  if($_POST['submit'] == 'login'){

    // contains error
    $err = array();
    
    if(!$_POST['username'] || !$_POST['password'])
        $err[] = 'All the fields must be filled in!';

    if( !count($err) ){

      // escape input data
      $_POST['username'] = mysql_real_escape_string($_POST['username']);
      $_POST['password'] = mysql_real_escape_string($_POST['password']);
      $_POST['rememberMe'] = (int)$_POST['rememberMe'];

      $user_row = $user->get_info();

      if($user_row['usr']){
        $user->set_login_session();
      }
      else {
        $err[] = 'Wrong username and/or password';
      }

    }

    if($err){
      // set the error message in session
      $_SESSION['msg']['login-err'] = implode('<br />',$err);
    }

    header("Location: ./");
    exit;
  }

?>