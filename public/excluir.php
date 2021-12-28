<?php
require 'config.php';
require '../dao/TaskDaoSqlserver.php'; 

$taskDao = new TaskDaoSqlServer($pdo);
$id = filter_input(INPUT_GET, 'id');

if($id){
    $taskDao->delete($id);
}
header('Location: '.$base."/index.php");
exit;