<?php   
require 'config.php';
require_once '../model/Auth.php';
$auth = new Auth($pdo, $base);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if($email && $password){
  
    $user = $auth->validateLogin($email, $password);

    if($user){
        header("Location: ".$base."/index.php");
       
        
        exit;
    }
}
$_SESSION['flash'] = 'E-mail e/ou senha inválidos';
header("Location: ".$base."login.php");	
exit;