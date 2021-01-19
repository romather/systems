<?php

namespace App\Extension;

use Pecee\Http\Url;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Twig\Extension\AbstractExtension;
use Twig\Node\Expression\ArrayExpression;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\TwigFunction;

class RoutingExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('url', [$this, 'getUrl'], ['is_safe_callback' => [$this, 'isSafe']]),
        ];
    }

    public function getUrl(?string $name = null, $parameters = null, ?array $getParams = null): Url
    {
        return Router::getUrl($name, $parameters, $getParams);
    }

    public function isSafe(Node $argsNode): array
    {
        $paramsNode = $argsNode->hasNode('parameters') ? $argsNode->getNode('parameters') : (
            $argsNode->hasNode(1) ? $argsNode->getNode(1) : null
        );
        if (null === $paramsNode || $paramsNode instanceof ArrayExpression && \count($paramsNode) <= 2 &&
            (!$paramsNode->hasNode(1) || $paramsNode->getNode(1) instanceof ConstantExpression)
        ) {
            return ['html'];
        }
        return [];
    }

}
