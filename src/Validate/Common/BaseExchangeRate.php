<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Internal\AssertPrefixPropertyTrait;
use PhpCfdi\CeUtils\Internal\AssertsStatus;
use PhpCfdi\CeUtils\Internal\FindAllNodes;
use PhpCfdi\CeUtils\Internal\PathPropertyTrait;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

abstract class BaseExchangeRate implements ValidatorInterface
{
    use AssertPrefixPropertyTrait, PathPropertyTrait;

    public function __construct(string $assertPrefix, string ...$path)
    {
        $this->assertPrefix = $assertPrefix;
        $this->path = $path;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $assert = $asserts->put(
            $this->getAssertCode('EXR'),
            'El tipo de cambio se establece únicamente cuando el registro no es en moneda nacional',
        );

        $count = 1;
        $nodes = FindAllNodes::find($root, ...$this->path);
        foreach ($nodes as $location => $node) {
            $this->validateNode($node, $asserts, $location, $count);
            $count = $count + 1;
        }

        $assert->setStatus(AssertsStatus::fromPrefix($asserts, $assert->getCode()));
    }

    private function validateNode(NodeInterface $node, Asserts $asserts, string $location, int $count): void
    {
        $currencyExists = $node->attributes()->exists('Moneda');
        $currency = $node['Moneda'];
        $currencyExplanation = $currencyExists ? $currency ?: '(vacía)' : '(ninguna)';

        $exchangeRate = $node['TipCamb'];
        $asserts->put(
            $this->getAssertCode('EXR') . sprintf('-%03d', $count),
            'El tipo de cambio debe tener un valor en caso de que la moneda sea diferente a moneda nacional',
            Status::when(! $currencyExists || '' !== $exchangeRate),
            sprintf('Moneda: %s, TipCamb: %s, Nodo: %s', $currencyExplanation, $exchangeRate, $location)
        );
    }
}
