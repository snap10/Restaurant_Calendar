<?php
    require_once ('utils/helper.php');
    function setupControllers($controller)
    {
        switch ($controller) {
            case 'pages':
                require_once('models/booking.php');
                require_once('models/venue.php');
                require_once('models/client.php');
                require_once('models/feature.php');
                $controller = new PagesController();
                break;
            case 'clients':
                // we need the model to query the database later in the controller
                require_once('models/client.php');
                $controller = new ClientsController();
                break;
            case 'bookings':
                // we need the model to query the database later in the controller
                require_once('models/booking.php');
                require_once('models/venue.php');
                require_once('models/client.php');
                require_once('models/feature.php');
                $controller = new BookingsController();
                break;
            case 'venues':
                // we need the model to query the database later in the controller
                require_once('models/venue.php');
                require_once('models/feature.php');
                $controller = new VenuesController();
                break;
            case 'features':
                // we need the model to query the database later in the controller
                require_once('models/feature.php');
                $controller = new FeaturesController();
                break;
            case 'ajax':
                // Handle AjaxCalls
                $controller = new AjaxController();
                break;
            case 'session':
                 $controller = new SessionController();
                break;
        }      
        return $controller;
    }
  function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
      $controller=setupControllers($controller);


    // call the action
    $controller->{ $action }();
  }

    function callWithMessage($controller,$action,$messagein){
        // require the file that matches the controller name
        require_once('controllers/' . $controller . '_controller.php');
        // create a new instance of the needed controller

        // create a new instance of the needed controller
        $controller=setupControllers($controller);
       global $message;
        if(isset($_GET['message'])){
            $messagein=Helper::test_input($_GET['message']);
        }
        $message=$messagein;


        // call the action
        $controller->{ $action }();
    }


  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array('pages' => ['home', 'error','notallowed'],'bookings' => ['index', 'show','showfromextern','newbooking','create','activatereservation','denyreservation'],'clients' => ['index', 'show'],'venues' => ['index', 'show'],'features' => ['index', 'show'],'ajax'=>[],'session'=>['login','register','logout']);

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      callWithMessage($controller, $action,null);
    } else {
      callWithMessage('pages', 'error','Action is not specified!');
    }
  } else {
    callWithMessage('pages', 'error','Controller is not specified!');
  }