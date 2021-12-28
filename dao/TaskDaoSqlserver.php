<?php
require_once '../model/Task.php';

class TaskDaoSqlServer implements TaskDao{
    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }


    public function insert(Task $t){
    
        $sql = $this->pdo->prepare("INSERT INTO tarefa (title, body, idUser) VALUES(:title, :body, :idUser)");
        $sql->bindValue(':title', $t->title);
        $sql->bindValue(':body', $t->body);
        $sql->bindValue(':idUser', $t->idUser);
        $sql->execute();
    }
    public function getTasks($idUser){
        $array= [];

        $sql = $this->pdo->prepare("SELECT * FROM tarefa WHERE idUser = :idUser ORDER BY idTask ASC");
        $sql->bindValue(':idUser', $idUser);
        $sql->execute();
  
        if($sql->rowCount() !== 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item){
                $t = new Task();
                $t->id = $item['idTask'];
                $t->title = $item['title'];
                $t->body = $item['body'];
                $t->idUser = $item['idUser'];
                $array[] = $t;
            }
        }
        return $array;
    }
    public function getIdTask($id){
        $sql = $this->pdo->prepare("SELECT * FROM tarefa WHERE idTask = :id");
        $sql->bindValue('id', $id);
        $sql->execute();

        if($sql->rowCount() !== 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $t = new Task();
            $t->id = $data['idTask'];
            $t->title = $data['title'];
            $t->body = $data['body'];
            $t->idUser = $data['idUser'];
            return $t;
        }
    }
    public function update(Task $t){
        $sql = $this->pdo->prepare("UPDATE tarefa SET title = :title, body = :body WHERE idTask = :id AND  idUser = :idUser");
        $sql->bindValue(":title",$t->title);
        $sql->bindValue(":body",$t->body);
        $sql->bindValue(":id", $t->id);
        $sql->bindValue(":idUser",$t->idUser);
        $sql->execute();
    }
    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM tarefa WHERE idTask = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
    }
}