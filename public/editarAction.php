<?php
require 'config.php';
require '../dao/TaskDaoSqlserver.php'; 

$taskDao = new TaskDaoSqlServer($pdo);

$id = filter_input(INPUT_POST,'id');
$idUser = filter_input(INPUT_POST,'idUser');
$title = filter_input(INPUT_POST,'title');
$body = filter_input(INPUT_POST,'body');

if ($id && $title && $body){
    $t = new Task();
    $t->id = $id;
    $t->title = $title;
    $t->body = $body;
    $t->idUser = $idUser;
    $taskDao->update($t);
    header('Location: '.$base."/index.php");
    exit;
}