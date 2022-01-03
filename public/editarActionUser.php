<?php
require 'config.php';
require '../dao/UserDaoSqlServer.php'; 

$userDao = new UserDaoSqlServer($pdo);

$id = intval($_POST['id']);
$token = $_POST['token'];
$password = $_POST['password'];
$name = filter_input(INPUT_POST,'name');
$email = filter_input(INPUT_POST,'email');

/* var_dump($password ,$token);
exit; */

if ($id && $name && $email ){
    $u = new User();
    $u->id =($id);
    $u->name = $name;
    $u->email = $email;
    $u->password = $password;
    $u->token = $token;
    $userDao->update($u); 
   
    header('Location: '.$base."/index.php");
    exit;
}
