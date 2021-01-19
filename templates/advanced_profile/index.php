<?php

require_once __DIR__ . '/../boot/setup.php';

use Tamtamchik\SimpleFlash\Flash;
use Tamtamchik\SimpleFlash\TemplateFactory;
use Tamtamchik\SimpleFlash\Templates;
use Carbon\Carbon;

$template = TemplateFactory::create(Templates::BOOTSTRAP_4);
$flash = new Flash($template);
$flash->setTemplate($template);

Session::put('user_token', $token);

if (!Auth::isLoggedIn()) {
    Redirect::to('home');
}

$nasc1 = Input::get('nascimento1');
$nasc2 = Input::get('nascimento2');
$nasc3 = Input::get('nascimento3');
$check_1 = Input::filtered('check_1');
$check_2 = Input::filtered('check_2');
$idade1 = Carbon::now()->setTimezone('America/Sao_Paulo')->diffInYears(Carbon::createFromDate($nasc1));
$idade2 = Carbon::now()->setTimezone('America/Sao_Paulo')->diffInYears(Carbon::createFromDate($nasc2));
$idade3 = Carbon::now()->setTimezone('America/Sao_Paulo')->diffInYears(Carbon::createFromDate($nasc3));

$stmt = Auth::findLogin(Session::get('login'));

if (($stmt->sou) == 'Homem') {
    $isSingle = true;
}

if (($stmt->sou) == 'Mulher') {
    $isSingle = true;
}

if (($stmt->sou) == 'Casal - Ele / Ela') {
    $isSingle = false;
}

if (($stmt->sou) == 'Casal - Ele / Ele') {
    $isSingle = false;
}

if (($stmt->sou) == 'Casal - Ela / Ela') {
    $isSingle = false;
}

if (($stmt->sou) == 'Transex') {
    $isSingle = true;
}

if (!empty($check_1) || !empty($check_2)) {
    header('HTTP/1.0 400 Bad Request');
    exit('Bad Response!');
    Redirect::to('home');
}

$age = 18;

if (Input::exists()) {
    $arr = [];
    if ($nasc1) {
        $arr['nasc1'] = $nasc1;
    }
    if ($nasc2) {
        $arr['nasc2'] = $nasc2;
    }
    if ($nasc3) {
        $arr['nasc3'] = $nasc3;
    }
    if ($idade1) {
        $arr['idade1'] = $idade1;
    }
    if ($idade2) {
        $arr['idade2'] = $idade2;
    }
    if ($idade3) {
        $arr['idade3'] = $idade3;
    }
    if (($idade1 > $age) or (($idade2 > $age) || ($idade > $age))) {
        Auth::updateLogin(Session::get('login'), $arr);
        $saida = $flash->success('Alterado com sucesso')->display();
    } else {
        $saida = $flash->success('Redirecionando...')->display();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="author" content="romather">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="<?= CSRF::setToken() ?>">
    <title>Editar Perfil</title>
    <script src="<?= url ?>/resources/js/jquery.min.js"></script>
    <script src="<?= url ?>/resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= url ?>/resources/parsley.js/parsley.min.js"></script>
    <script src="<?= url ?>/resources/parsley.js/i18n/pt-br.js"></script>
    <link rel="stylesheet" href="<?= url ?>/resources/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= url ?>/resources/parsley.js/parsley.css">
    <link rel="stylesheet" href="<?= url ?>/resources/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= url ?>/resources/css/edit.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4267b2;">
        <a class="navbar-brand" href="social">
            <img src="" class="d-inline-block align-top" alt="">
            Swee
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="social"><?php Perfil() ?></a>
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
                        <a class="dropdown-item" href="">
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

    <br><br><br>

    <div class="container">
        <div class="row flex-lg-nowrap">
            <div class="col-12 col-lg-auto mb-3" style="width: 210px;">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link px-2 active" href="edit_profile"><i class="fas fa-chart-bar mr-1"></i><span>Perfil Básico</span></a></li>
                            <li class="nav-item"><a class="nav-link px-2" href="info"><i class="fas fa-th mr-1"></i><span>Perfil Avançado</span></a></li>
                            <li class="nav-item"><a class="nav-link px-2" href="config"><i class="fas fa-cog mr-1"></i><span>Configuração</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="row">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="e-profile">
                                    <form method="post" action="<?php $phpself; ?>" enctype="multipart/form-data" data-parsley-validate="">
                                        <?= CSRF::generateToken() ?>
                                        <input name="check_1" type="hidden" value="">
                                        <input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="check_2" type="text">
                                        <div class="row">
                                            <div class="col-12 col-sm-auto mb-3">
                                                <div class="mx-auto" style="width: 140px;">
                                                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 150px; background-color: rgb(233, 236, 239);">
                                                        <img src="<?= url ?>/img/padrao.png" id="imgFoto" class="imgFoto" name="imgFoto" alt="Foto Perfil" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php Perfil(); ?></h4>
                                                    <p class="mb-0"><small><?php TipoPerfil(); ?></small></p>
                                                    <div class="text-muted"><small><?php TempoAtivo(); ?></small></div>
                                                    <div class="mt-2">
                                                        <input type="file" name="imgPerfil" id="imgPerfil" accept="image/jpeg,image/jpg,image/png,image/gif">
                                                        <label for="imgPerfil">Escolher Imagem</label>
                                                    </div>
                                                </div>
                                                <div class="text-center text-sm-right">
                                                    <span class="badge badge-secondary"><?php TipoUsuario() ?></span>
                                                    <div class="text-muted"><small>Entrou em <?php DataEntrada(); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="" id="edit" class="active nav-link">INFORMAÇÕES ADICIONAIS</a></li>
                                        </ul>

                                        <div class="tab-content pt-3">
                                            <div class="tab-pane active">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div id="flash" class="flash">
                                                                    <?php
                                                                    if (isset($saida)) {
                                                                        echo $saida;
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php if (($isSingle) == true) { ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="nascimento1">Data de Nascimento</label>
                                                                        <input class="form-control" type="date" name="nascimento1" id="nascimento1" placeholder="00/00/0000">
                                                                    </div>
                                                                </div>
                                                                <div class="col"></div>
                                                            </div>
                                                        <?php } elseif (($isSingle) == false && ($isSingle) == null) { ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="nascimento2">Data Nascimento - parceiro/a</label>
                                                                        <input class="form-control" type="date" name="nascimento2" id="nascimento2" placeholder="00/00/0000">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="nascimento3">Data Nascimento - parceiro/a</label>
                                                                        <input class="form-control" type="date" name="nascimento3" id="nascimento3" placeholder="00/00/0000">
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col d-flex justify-content-end">
                                                        <button class="btn btn-primary" type="submit" name="atualizar" id="atualizar">Atualizar perfil</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="px-xl-3">
                                    <a class="btn btn-block btn-secondary" href="logout?token=<?= Session::get('user_token') ?>">
                                        <i class="fa fa-sign-out"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            setTimeout(function() {
                $('#flash').fadeOut('slow');
            }, 2000);

            var p = $("#imgFoto");
            $("body").on("change", "#imgPerfil", function() {
                var imageReader = new FileReader();
                imageReader.readAsDataURL(document.getElementById("imgPerfil").files[0]);
                imageReader.onload = function(oFREvent) {
                    p.attr('src', oFREvent.target.result).fadeIn();
                };
            });

            $('.imgFoto').each(function() {
                var maxWidth = 150; // Max width for the image
                var maxHeight = 150; // Max height for the image
                var ratio = 0; // Used for aspect ratio
                var width = $(this).width(); // Current image width
                var height = $(this).height(); // Current image height

                // Check if the current width is larger than the max
                if (width > maxWidth) {
                    ratio = maxWidth / width; // get ratio for scaling image
                    $(this).css("width", maxWidth); // Set new width
                    $(this).css("height", height * ratio); // Scale height based on ratio
                    height = height * ratio; // Reset height to match scaled image
                }

                var width = $(this).width(); // Current image width
                var height = $(this).height(); // Current image height

                // Check if current height is larger than max
                if (height > maxHeight) {
                    ratio = maxHeight / height; // get ratio for scaling image
                    $(this).css("height", maxHeight); // Set new height
                    $(this).css("width", width * ratio); // Scale width based on ratio
                    width = width * ratio; // Reset width to match scaled image
                }
            });
        });
    </script>
</body>

</html>