<?php

require_once __DIR__ . '/../boot/setup.php';

if (!Auth::isLoggedIn()) {
    Redirect::to('/home');
}

Session::put('user_token', $token);

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="romather">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
        <?= $this->csrf_meta_widget() ?>
        <meta name="theme-color" content="#4285f4">
        <meta name="msapplication-navbutton-color" content="#4285f4">
        <meta name="apple-mobile-web-app-status-bar-style" content="#4285f4">
        <title>Swee</title>
        <script src="resources/js/jquery.min.js'?>"></script>
        <script src="resources/bootstrap/js/bootstrap.bundle.min.js'?>"></script>
        <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css'?>">
        <link rel="stylesheet" href="resources/fontawesome-free/css/all.min.css'?>">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4267b2;">
            <a class="navbar-brand" href="<?= $router->pathFor('profile.social') ?>">
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
                        <a class="nav-link" href="<?= $router->pathFor('profile.social') ?>">
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
                            <a class="dropdown-item" href="">
                                <i class="fas fa-lock-open"></i>
                                Mudar Senha
                            </a>
                            <a class="dropdown-item" href="delete_profile">
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
    </body>
</html>