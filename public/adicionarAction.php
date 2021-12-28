<?php
require 'config.php';
require_once '../dao/UserDaoSqlServer.php'; 
require '../dao/TaskDaoSqlserver.php';
require '../model/Auth.php';


$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();



$title = filter_input(INPUT_POST,'title');
$body = filter_input(INPUT_POST,'body');

if($title && $body){
    $taskDao = new TaskDaoSqlServer($pdo);

    $newTask = new Task();
    $newTask->idUser = $userInfo->id;
    $newTask->title = $title;
    $newTask->body = $body;

    $taskDao->insert($newTask);
    header('Location: '.$base."/index.php");
    exit;
}else{   
    header('Location: '.$base."/adicionar.php");
    exit;
}


