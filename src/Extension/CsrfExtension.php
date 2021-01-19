<?php

namespace App\Extension;

use Laminas\Escaper\Escaper;
use Riimu\Kit\CSRF\NonceValidator as Nonce;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;


class CsrfExtension extends AbstractExtension
{
    protected $tokenName;

    public function __construct($tokenName = 'csrf_token')
    {
        $this->tokenName = $tokenName;
    }

    public function getName()
    {
        return 'helpers';
    }

    public function getFunctions()
    {
        return [               
            new TwigFunction('csrf_token_name', [$this, 'getTokenName']),
            new TwigFunction('csrf_token', [$this, 'generateCsrfToken']),
            new TwigFunction('csrf_input_widget', [$this, 'generateHiddenInput'], ['needs_environment' => true, 'is_safe' => ['html']]),
            new TwigFunction('csrf_meta_widget', [$this, 'generateMetaInput'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }  

    public function getTokenName()
    {
        return $this->tokenName;
    }

    public function generateCsrfToken(): string
    {
        $escaper = new Escaper('utf-8');
        $csrf = new Nonce();
        if ($csrf->getNonceCount() > 100) {
            $csrf->regenerateToken();
        }
        $token = $escaper->escapeHtml($csrf->getToken());
        return $token;
    }

    public function generateHiddenInput(Environment $env): string
    {
        $token = twig_escape_filter($env, $this->generateCsrfToken(), 'html');
        $tokenName = twig_escape_filter($env, $this->getTokenName(), 'html');
        return sprintf('<input name="%s" type="hidden" value="%s">', $tokenName, $token);
    }

    public function generateMetaInput(Environment $env): string
    {
        $token = twig_escape_filter($env, $this->generateCsrfToken(), 'html');
        $tokenName = twig_escape_filter($env, $this->getTokenName(), 'html');
        return sprintf('<meta name="%s" content="%s">', $tokenName, $token);
    }
}
