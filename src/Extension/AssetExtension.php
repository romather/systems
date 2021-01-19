<?php

namespace App\Extension;

use Symfony\Component\Asset\Packages;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    private $packages;

    public function __construct(Packages $packages)
    {
        $this->packages = $packages;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('assets', [$this, 'getAsset']),
        ];
    }

    public function getAsset(string $path, string $packageName = null): string
    {
        return $this->packages->getUrl($path, $packageName);
    }

}
