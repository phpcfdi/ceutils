<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Nodes\Nodes;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Internal\AssertPrefixPropertyTrait;
use PhpCfdi\CeUtils\Internal\AssertsStatus;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

abstract class BaseUniquePolizaNumber implements ValidatorInterface
{
    use AssertPrefixPropertyTrait;

    private string $childName;

    public function __construct(string $assertPrefix, string $childName)
    {
        $this->assertPrefix = $assertPrefix;
        $this->childName = $childName;
    }

    public function getChildName(): string
    {
        return $this->childName;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $assert = $asserts->put(
            $this->getAssertCode(''),
            'En un mes ordinario no debe repetirse un mismo número de póliza',
        );

        $nodes = $root->children()->getNodesByName($this->childName);
        foreach ($nodes as $index => $node) {
            $this->validateNode($nodes, $index, $node, $asserts);
        }

        $assert->setStatus(AssertsStatus::fromPrefix($asserts, $assert->getCode()));
    }

    private function validateNode(Nodes $nodes, int $index, NodeInterface $node, Asserts $asserts): void
    {
        $numUnIdenPol = $node['NumUnIdenPol'];
        $repeated = $this->filterByNumUnIdenPol($nodes, $node);
        $count = $repeated->count();
        $asserts->put(
            $this->getAssertCode(sprintf('-%03d', $index + 1)),
            'En un mes ordinario no debe repetirse un mismo número de póliza',
            Status::when(0 === $count),
            sprintf('NumUnIdenPol: %s, Apariciones: %d', $numUnIdenPol, $count),
        );
    }

    private function filterByNumUnIdenPol(Nodes $nodes, NodeInterface $baseNode): Nodes
    {
        $filtered = new Nodes();
        $value = $baseNode['NumUnIdenPol'];
        foreach ($nodes as $node) {
            if ($baseNode !== $node && $value === $node['NumUnIdenPol']) {
                $filtered->add($node);
            }
        }
        return $filtered;
    }
}
