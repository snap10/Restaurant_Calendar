<?php
  class ClientsController {
    public function index() {
      // we store all the posts in a variable
      $clients = Client::all();
      require_once('views/clients/index.php');
    }

    public function show() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      // we use the given id to get the right post
      $client = Client::find($_GET['id']);
      require_once('views/clients/show.php');
    }
  }
?>