<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Internal;

use CfdiUtils\Nodes\NodeInterface;

final class FindAllNodes
{
    /** @return array<string, NodeInterface> */
    public static function find(NodeInterface $root, string ...$path): array
    {
        $finder = new self();
        return $finder->findAll($root, ...$path);
    }

    /** @return array<string, NodeInterface> */
    public function findAll(NodeInterface $node, string ...$path): array
    {
        $location = $this->buildLocation('', $node->name(), 0);
        return $this->findAllNodesRecursive($node, $location, ...$path);
    }

    /** @return array<string, NodeInterface> */
    private function findAllNodesRecursive(NodeInterface $node, string $location, string ...$path): array
    {
        $descendantName = array_shift($path);
        $isFinal = ([] === $path);

        $found = [];
        foreach ($node->children()->getNodesByName($descendantName) as $index => $descendant) {
            $newLocation = $this->buildLocation($location, $descendantName, $index);
            if ($isFinal) {
                $found[$newLocation] = $descendant;
            } else {
                $found = $found + $this->findAllNodesRecursive($descendant, $newLocation, ...$path);
            }
        }
        return $found;
    }

    private function buildLocation(string $parentLocation, string $nodeName, int $index): string
    {
        return sprintf('%s/%s[%d]', $parentLocation, $nodeName, $index);
    }
}
