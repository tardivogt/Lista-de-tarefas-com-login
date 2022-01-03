<?php
require '../model/User.php';

class UserDaoSqlServer implements UserDao{
    private $pdo;

    public function __construct(PDO $driver) {
        $this->pdo = $driver;
    }

    private function generateUser($array) {
        $u = new User();
        $u->id = $array['id'] ?? 0;
        $u->email = $array['email'] ?? '';
        $u->name = $array['name'] ?? '';
        $u->password = $array['password'] ?? '';
        $u->token = $array['token'] ?? '';
        return $u;
    }

    public function findByToken($token) {
        if(!empty($token)){
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            if($sql->rowCount() !== 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
                return $user;
            }
        }

        return false;
    }

    public function findByEmail($email) {
        if(!empty($email)){
            $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if($sql->rowCount() !== 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
                return $user;
            }
        }
        return false;
    }
    public function update(User $u){
        $sql = $this->pdo->prepare("UPDATE usuario SET  
        name = :name, 
        email = :email,
        password = :password,
        token = :token 
        WHERE id = :id");
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':id', $u->id); 
        $sql->bindValue(':password', $u->password); 
        $sql->bindValue(':token', $u->token); 
        $sql->execute();

        return true;
    }
    public function insert(User $u){
        
        $sql = $this->pdo->prepare("INSERT INTO usuario (name, email, password, token) VALUES (:name, :email, :password, :token)");
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':token', $u->token);
        $sql->execute();

        return true;
    }
 
    public function getIdUser($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() !== 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $u = new Task();
            $u->id = $data['id'];
            $u->name = $data['name'];
            $u->email = $data['email'];
            $u->password = $data['password'];
            return $u;
        }
    }

}