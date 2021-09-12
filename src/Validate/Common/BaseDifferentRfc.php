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

abstract class BaseDifferentRfc implements ValidatorInterface
{
    use AssertPrefixPropertyTrait;
    use PathPropertyTrait;

    public function __construct(string $assertPrefix, string ...$path)
    {
        $this->assertPrefix = $assertPrefix;
        $this->path = $path;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $assert = $asserts->put(
            $this->getAssertCode(''),
            'Los RFC de la información detallada deben ser distintos al RFC del emisor',
        );

        $issuerRfc = $root['RFC'];
        $count = 1;
        $nodes = FindAllNodes::find($root, ...$this->path);
        foreach ($nodes as $location => $node) {
            $this->validateNode($issuerRfc, $node, $asserts, $location, $count);
            $count = $count + 1;
        }

        $assert->setStatus(AssertsStatus::fromPrefix($asserts, $assert->getCode()));
    }

    private function validateNode(
        string $issuerRfc,
        NodeInterface $node,
        Asserts $asserts,
        string $location,
        int $count
    ): void {
        $rfc = $node['RFC'];
        $asserts->put(
            $this->getAssertCode(sprintf('-%03d', $count)),
            'El RFC de referencia debe ser distinto al registro del que envía los datos',
            Status::when($issuerRfc !== $rfc),
            sprintf('RFC Emisor: %s, RFC: %s, Nodo: %s', $issuerRfc, $rfc, $location)
        );
    }
}
