<?php
  class PagesController {
    public function home() {
      global $message;
      require_once('views/pages/home.php');
    }

    public function error() {
      global $message;
      require_once('views/pages/error.php');
    }
    public function notallowed(){
      global $message;
      require_once ('views/pages/notallowed.php');
    }

  }
?>