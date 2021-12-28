<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <section>            
            <div class="color">
                <div class="container">
                    <div class="form_container"></div>
                        <div class="login">
                            <form method="POST" action="<?=$base?>/signupAction.php">
                                <div class="form-group" >
                                    <?php if(!empty($_SESSION['flash'])):?>
                                        <div class="alert alert-danger form-control input" role="alert">
                                        <?=$_SESSION['flash'];?>
                                        <?php $_SESSION['flash'] = '';?>
                                        </div>
                                    <?php endif ?>
                                    <label for="login" >Nome Completo:</label></br>
                                    <input class="form-control input" type="text" name="name" placeholder="Nome Completo"></br>
                                    <label for="login" >Email:</label></br>
                                    <input class="form-control input" type="email" name="email" placeholder="E-mail" ></br>
                                    <label for="login" >Senha:</label></br>
                                    <input class="form-control input" type="password" name="password" placeholder="Senha"></br>
                                    <button class="btn btn-primary" type="submit" role="button" >Finalizar Cadastro</button></br></br>
                                    <!-- <button class="btn btn-primary" type="submit"   onclick="validar()" ></button> -->
                                    <a class="btn btn-primary" href="login.php" role="button">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
/*             function validar() {
                var nome =formulario.nomer;
                var email =formulario.emailr;
                var senha =formulario.senhar;
                if (nome.value == "") {
                    alert("Email não informado");
                    // Deixa o input com o focus
                    nome.focus();
                    // retorna a função e não olha as outras linhas
                }else if(email.value == "") {
                    alert("Senha não informada");
                    email.focus();
                }else if(senha.value == "") {
                    alert("Senha não informada");
                    senha.focus();
                }
                    alert("Formulário enviado!");     
            } */
            </script>
     
    </body>
</html>