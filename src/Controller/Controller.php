<?php

namespace App\Controller;

use App\Extension\AssetExtension;
use App\Extension\CsrfExtension;
use App\Extension\RoutingExtension;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    protected function renderView(string $templates, array $data = [])
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/../templates');
        $twig = new Environment($loader);
        $twig->addExtension(new AssetExtension(new Packages(new Package(new EmptyVersionStrategy()))));
        $twig->addExtension(new RoutingExtension());
        $twig->addExtension(new CsrfExtension());
        echo $twig->render($templates, $data);
    }

    public function render(string $templates, array $data = [])
    {
        return $this->renderView($templates, $data);
    }
}
