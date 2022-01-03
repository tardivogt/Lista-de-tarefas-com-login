<?php
require 'config.php';
require_once '../model/Auth.php'; 
require '../dao/TaskDaoSqlserver.php';


$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$userTasks = new TaskDaoSqlServer($pdo);
$tasks = $userTasks->getTasks($userInfo->id);

$id = filter_input(INPUT_GET,'id');
$userEditar = new UserDaoSqlServer($pdo);

if($id){
    $user= $userEditar->getIdUser($id);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
        <title>Perfil</title>
    </head>
    <body>
        <header>    
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Perfil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"><span class="navbar-toggler-icon"></span></button>
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a href="logout.php" aria-current="page" class="nav-link active">logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>     
        <section class="adicionar_container">    
            <div class="color">
                <div class="container">
                    <div class="form_container">
                        <div class="login">
                            <form method="post">
                                <div class="form-group">
                                    <label for="login" >Nome Completo:<input name="name" class="form-control" value="<?=$userInfo->name?>" readonly></label></br>
                                    <label for="login" >Email:<input type="text" name="email" class="form-control email_perfil" value="<?=$userInfo->email?>" readonly></label></br></br>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal1"><i class="fas fa-pen"></i></button>
                                </div>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
        </section>        
        <section class="adicionar_container">
            <div class="modal fade" id="modal1" tabindex="-1"aria-labelledby="modalLabel"aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Editar Cadastro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm ">
                                        <form method="POST" action="editarActionUser.php?id=<?=$userInfo->id?>">  
                                            <input type="hidden" name="id" value="<?=$userInfo->id?>" />
                                            <input type="hidden" name="token" value="<?=$userInfo->token?>" />
                                            <label for="editar">Nome Completo:<input type="text" name="name" class="form-control" placeholder="Name" value="<?=$userInfo->name?>"></label>
                                            <label for="editar">Email:<input class="form-control" rows="5" name="email"  placeholder="Email" value="<?=$userInfo->email;?>"></label>
                                            <label for="editar">Senha:<input id="pwd" type="text" name="password" value="<?=$userInfo->password?>"></label>
                                            <input class="form-control btn-dark" type="submit" name="submit" value="Salvar"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <table class="table">
                <thead>
                    <tr> 
                        <th scope="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-tasks"></i></button></th>
                        <th scope="col">Id</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descricao</th>
                    </tr>
                </thead>
                <tbody>  
                    <?php foreach ($tasks as $task): ?>   
                    <tr>
                        <td></td>
                        <td><?= $task->id?></td>
                        <td><?= $task->title?></td>
                        <td><?= $task->body?><td>    
                        <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal<?= $task->id?>"><i class="fas fa-pen"></i></button></td>
                        <td><a href="<?=$base?>/excluir.php?id=<?= $task->id?>" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></a></td>      
                    </tr>
                    <section class="adicionar_container">
                        <div class="modal fade" id="modal<?= $task->id?>" tabindex="-1"aria-labelledby="modalLabel"aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Editar Tarefa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-sm ">
                                                    <form method="POST" action="editarAction.php">  
                                                        <input type="hidden" name="id" value="<?=$task->id?>" />
                                                        <input type="hidden" name="idUser" value="<?=$task->idUser?>" />
                                                        <input type="text" name="title" class="form-control" placeholder="Título" value="<?=$task->title;?>" >
                                                        <textarea class="form-control" rows="5" name="body"  placeholder="Tarefa" ><?=$task->body;?></textarea>
                                                        <input class="form-control btn-dark" type="submit" name="submit" value="Salvar"/>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php endforeach; ?> 
                </tbody>
            </table>
        </section>
        <section class="adicionar_container">
            <div class="modal fade" id="exampleModal" tabindex="-1"aria-labelledby="exampleModalLabel"aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cadastre Tarefa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm ">
                                            <form method="POST" action="adicionarAction.php">  
                                            <input type="text" name="title" class="form-control" placeholder="Título" >
                                            <textarea class="form-control" rows="5" name="body"  placeholder="Tarefa" ></textarea>
                                            <input class="btn btn-primary" type="submit" name="submit" value="Cadastrar"/>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>

