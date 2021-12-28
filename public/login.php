<?php
require 'config.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
        <section>
            <div class="color">
                <div class="container">
                    <div class="form_container">
                        <div class="login">
                            <form method="post" action="<?=$base?>/loginAction.php" name="formulario">
                                <div class="form-group">
                                    <?php if(!empty($_SESSION['flash'])):?>
                                        <div class="alert alert-danger form-control input" role="alert">
                                            <?=$_SESSION['flash'];?>
                                            <?php $_SESSION['flash'] = '';?>
                                        </div>
                                    <?php endif ?>
                                    <label for="login">Login:</label></br>
                                    <input class="form-control input" type="email" name="email" placeholder="E-mail"></br>
                                    <label for="login">Senha:</label></br>
                                    <input class="form-control input" type="password" id="pass" name="password" placeholder="Senha"></br>
                                    <button class="btn btn-primary" type="submit" value="Entrar">Entrar</button>
              <!--                       <button type="submit" rel="stylesheet"class="btn btn-primary">Entrar1</button> -->
                                    <p class="input text-center">Ainda não tem cadastro? <a href="signup.php">Cadastre-se</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>