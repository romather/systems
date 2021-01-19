<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="author" content="romather">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Mudar Senha</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha256-fzFFyH01cBVPYzl16KT40wqjhgPtq6FFUB6ckN2+GGw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.1/dist/parsley.min.js" integrity="sha256-NIrmL5MpKPRrVKsHLnkWp5u4vNpVp2fKLoFOz96mHUY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.1/dist/i18n/pt-br.js" integrity="sha256-O7uypvHi5HUgmpDue+cOfDckXQ/vFI3mebG4M72MGUw=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.10.1/css/all.min.css" integrity="sha256-fdcFNFiBMrNfWL6OcAGQz6jDgNTRxnrLEd4vJYFWScE=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.1/src/parsley.css" integrity="sha256-ijxWb+WQVbVbvYVgeCtfqFIeaulT0pmecHAxK3Ornz8=" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= Url::base_url(TRUE) . 'resources/css/main.css' ?>">
</head>

<body class="my-email-page">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4267b2;">
        <a class="navbar-brand" href="/">
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
                    <a class="nav-link" href="">
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
                            Esqueceu a senha
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
    <br><br><br><br><br><br>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Esqueceu a senha</h4>
                            <div class="flash" id="flash">
                                <?php
                                if (isset($saida)) :
                                    echo $saida;
                                endif;
                                ?>
                            </div>

                            <form method="post" class="my-login-validation" data-parsley-validate="">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input id="email" type="text" class="form-control" name="email" autofocus>
                                    <div class="form-text text-muted">
                                        Para finalizar o processo, será enviado um link para o e-mail
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Resetar Senha
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            setTimeout(function() {
                $('#flash').fadeOut('slow');
            }, 1800);          
        });
    </script>
</body>

</html>