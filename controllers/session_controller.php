<?php
require_once('utils/helper.php');


class SessionController
{
  public function login() {
      global $message;
      require_once('utils/loginhandler.php');
     
  }
  public function register() {
      global $message;
      require_once('utils/registerhandler.php');
    
  }
  public function logout() {
      global $message;
      require_once('utils/logouthandler.php');
     
  }
  
}

?>