<?php session_start();?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap4.css">
    <link rel="stylesheet" href="css/calendar.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>


</head>
    <body>
    <header>
        <nav class="navbar navbar-full  bg-inverse">
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#topnavbar">
                &#9776;
            </button>
            <div class="collapse navbar-toggleable-xs" id="topnavbar">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a  class="nav-link" href='index.php'>Home</a></li>
                    <li class="nav-item"><a  class="nav-link" href='index.php?controller=venues&action=index'>Venues</a></li>
                    <li class="nav-item"><a  class="nav-link" href='index.php?controller=features&action=index'>Features</a></li>
                    <?php if(isset($_SESSION['valid'])&&$_SESSION['valid']==true) { ?>
                    <li class="nav-item"><a  class="nav-link" href='index.php?controller=clients&action=index'>Clients</a></li>
                    <li class="nav-item"><a  class="nav-link" href='index.php?controller=bookings&action=index'>Bookings</a></li>
<?php
  }?>
                </ul>
                <?php if(!isset($_SESSION['valid'])||$_SESSION['valid']==false) {    ?>
                <div class="pull-xs-right" id="login">
                <form class="form-inline" method="post" action="index.php?controller=session&action=login">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="useremail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

                    <button class="btn btn-primary" type="submit">Einloggen</button>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#registersection">Registrieren</button>
                </form>

                <div id="registersection" class="collapse">
                    <form class="form-horizontal"  method="post" action="index.php?controller=session&action=register">
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" name="useremail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <label for="inputPassword2" class="sr-only">Password wiederholen</label>
                        <input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="Password" required>
                        <button class="btn btn-primary" type="submit">Abschicken</button>
                    </form>
                </div>
                </div>
                <?php } ?>
                
            </div>
           

                <?php
                 

                    if(isset($_SESSION['valid'])&&$_SESSION['valid']==true) { ?>
                    <div class="pull-xs-right " id="login">
                        <form class="form-inline" method="post" action="index.php?controller=session&action=logout">
                            <span>Hello <?php echo $_SESSION['username']; ?></span>
                            <button class="btn btn-primary" type="submit">Abmelden</button>
                        </form>
                        </div>
                    <?php }?>
            
            
        </nav>
    </header>
    <main>
    <?php require_once('routes.php'); ?>
    </main>
    <footer class="bg-inverse footer">
        <p>Copyright reserved @ Ferdinand Birk 2016<p>
    </footer>
    </body>
    </html>
