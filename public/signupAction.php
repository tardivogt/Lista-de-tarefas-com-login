<?php  

require 'config.php';
require_once '../model/Auth.php';


$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');


if($name && $email && $password){
    
    $auth = new Auth($pdo, $base);

    if($auth->emailExists($email) === false){
    
        $auth->registerUser($name, $email, $password);
   
        header("Location: ".$base.'/login.php');	

        exit;

    }else{
        $_SESSION['flash'] = 'E-mail já cadastrado!';
        header("Location: ".$base.'/signup.php');	
        exit;
    }
    
}
$_SESSION['flash'] = 'Campos não enviados';
header("Location: ".$base.'/signup.php');	
exit;
