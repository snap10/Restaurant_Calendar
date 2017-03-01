<?php
/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 08.03.16
 * Time: 15:33
 */
 if(!isset($_SESSION)){
    session_start();
    }
session_unset();
session_destroy();
header('location: index.php?message=Erfolgreich ausgeloggt"');
    exit;

?>