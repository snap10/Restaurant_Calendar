<?php
/**
 * Created by IntelliJ IDEA.
 * User: Snap10
 * Date: 08.03.16
 * Time: 15:33
 */

 function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require_once ('DBHandler.php');


// username and password sent from form
$myusername=$_POST['useremail'];
$mypassword=$_POST['password'];



// To protect MySQL injection (more detail about MySQL injection)
$myusername = test_input($myusername);
$mypassword = test_input($mypassword);

$db = Db::getInstance();
// we make sure $id is an integer


/**
 * Note that the salt here is randomly generated.
 * Never use a static salt or one that is not randomly generated.
 *
 * For the VAST majority of use-cases, let password_hash generate the salt randomly for you
 */
$req = $db->prepare('SELECT salt FROM users WHERE userEmail = ?');
$req->bind_param('s', $myusername);
// the query was prepared, now we replace :id with our actual $id value
$req->execute();
$req->bind_result($salt);
$usersalt=$req->fetch();
$options = [
    'cost' => 11,
    'salt' => $salt,
];
$req->close();
$hashedPassword= password_hash($mypassword, PASSWORD_BCRYPT, $options);


$req = $db->prepare('SELECT id FROM users WHERE userName = ? and userPassword=? and enable=1');
$req->bind_param('ss', $myusername,$hashedPassword);
// the query was prepared, now we replace :id with our actual $id value
$req->execute();
$req->store_result();


$count = $req->num_rows;
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
     if(!isset($_SESSION)){
    session_start();
    }
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = $myusername;
   
    header('location:index.php?message=Logged in successfully');
    exit;
    }else {
    header('location: index.php?message=Not logged in, wrong Credentials"');
    exit;
}




?>