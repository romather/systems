<?php

require_once __DIR__ . '/../boot/setup.php';
if (!Auth::isLoggedIn()) {
    Redirect::to('home');
}

if (Input::exists()) {
    if (Cookie::exists('SNID')) {
        Auth::deleteAll(Session::get('login'), Auth::isLoggedIn(), Cookie::get('SNID'));
    }
    Cookie::delete('SNID');
    Cookie::delete('SNID_');
    Redirect::to('home');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <meta charset="utf-8">
        <meta name="author" content="romather">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
        <title>Deletar Conta</title>
        <script src="<?= url ?>/resources/js/jquery.min.js"></script>
        <script src="<?= url ?>/resources/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= url ?>/resources/parsley.js/parsley.min.js"></script>
        <script src="<?= url ?>/resources/parsley.js/i18n/pt-br.js"></script>
        <link rel="stylesheet" href="<?= url ?>/resources/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= url ?>/resources/parsley.js/parsley.css">
        <link rel="stylesheet" href="<?= url ?>/resources/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="<?= url ?>/resources/css/main.css">
    </head>

    <body class="my-login-page">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4267b2;">
            <a class="navbar-brand" href="home">
                <img src="" class="d-inline-block align-top" alt="">
                Swee
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">                       
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                <?php Perfil() ?>
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                Rede
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="social">
                                Página Inicial
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                Encontrar Amigos
                            </a>
                        </li>

                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                <i class="fas fa-user-friends"></i>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                <i class="fab fa-facebook-messenger"></i>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="">
                                <i class="fas fa-1x fa-cog"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="edit_profile">
                                    <i class="fas fa-user-edit"></i>
                                    Editar Perfil
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-network-wired"></i>
                                    Rede
                                </a>
                                <a class="dropdown-item" href="reset">
                                    <i class="fas fa-lock-open"></i>
                                    Mudar Senha
                                </a>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user-minus"></i>
                                    Deletar Conta
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-cogs"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="logout?token=<?= Session::get('user_token') ?>">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>                
            </div>
        </nav>
        <br><br><br><br><br><br><br><br><br>
        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center align-items-center h-100">
                    <div class="card-wrapper">
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title">Deletar Conta</h4>                            
                                <form method="post" data-parsley-validate="">
                                    <div class="form-group">
                                        <label for="login">Login</label>
                                        <input id="login" type="text" class="form-control" name="login" placeholder="E-mail ou Nome de Usuário" minlength="4" required autofocus value="<?= Session::get('login') ?>">
                                    </div>                                

                                    <div class="form-group m-0">
                                        <button type="submit" name="confirmar" id="confirmar" class="btn btn-primary btn-block">
                                            Deletar Conta
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>