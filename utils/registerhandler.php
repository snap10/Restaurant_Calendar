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
$userEmail=$_POST['useremail'];
$mypassword=$_POST['password'];
$mypassword2=$_POST['password2'];
// To protect MySQL injection (more detail about MySQL injection)
$userEmail = test_input($userEmail);
$mypassword = test_input($mypassword);
$mypassword2 = test_input($mypassword2);
if(strcmp($mypassword,$mypassword2)!=0){
    header('location: ../index.php?message=Passwords have to be equal"');
    exit;
}

$db = Db::getInstance();
// we make sure $id is an integer


$usersalt=mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);

$options = [
    'cost' => 11,
    'salt' => $usersalt,
];
$hashedPassword= password_hash($mypassword, PASSWORD_BCRYPT, $options);

$null=0;
$req = $db->prepare('INSERT INTO users (userEmail,userName,userPassword,enable,salt) VALUES (?,?,?,?,?)');
$req->bind_param('sssis', $userEmail,$userEmail,$hashedPassword,$null,$usersalt);
// the query was prepared, now we replace :id with our actual $id value
$req->execute();
$id=$req->insert_id;
if(intval($id)){
    header('location: index.php?message=Registred,please contact Administrator to enable!"');
    exit;
}else{
    header('location: index.php?message=Error while Registering"');
    exit;
}




?>