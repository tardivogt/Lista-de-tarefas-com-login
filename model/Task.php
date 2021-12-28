<?php
class Task{
    public $id;
    public $title;
    public $body;
    public $idUser;
}
interface TaskDao{
    public function insert(Task $t);
    public function update(Task $t);
    public function getTasks($idUser);
    public function getIdTask($id);
    public function delete($id);
}



