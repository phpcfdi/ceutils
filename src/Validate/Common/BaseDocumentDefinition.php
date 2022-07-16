<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

abstract class BaseDocumentDefinition implements ValidatorInterface
{
    private string $assertPrefix;

    private string $rootElementName;

    private string $namespace;

    public function __construct(string $assertPrefix, string $rootElementName, string $namespace)
    {
        $this->assertPrefix = $assertPrefix;
        $this->rootElementName = $rootElementName;
        $this->namespace = $namespace;
    }

    public function getAssertName(string $suffix): string
    {
        return $this->assertPrefix . $suffix;
    }

    public function getRootElementName(): string
    {
        return $this->rootElementName;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $nodeName = $this->validateNodeName($root, $asserts);
        $namespace = $this->validateNamespace($root, $asserts);

        if (! $nodeName || ! $namespace) {
            $asserts->mustStop(true);
        }
    }

    private function validateNodeName(NodeInterface $root, Asserts $asserts): bool
    {
        $nodeName = $root->name();
        $status = Status::when($this->getRootElementName() === $nodeName);

        $asserts->put(
            $this->getAssertName('01'),
            'El documento tiene el nombre del nodo principal correcto',
            $status,
            sprintf('Esperado: %s, Actual: %s.', $this->getRootElementName(), $nodeName),
        );

        return $status->isOk();
    }

    private function validateNamespace(NodeInterface $root, Asserts $asserts): bool
    {
        $nsPrefix = explode(':', $this->getRootElementName())[0];
        $namespace = $root['xmlns:' . $nsPrefix];
        $status = Status::when($this->getNamespace() === $namespace);

        $asserts->put(
            $this->getAssertName('02'),
            'El documento tiene el espacio de nombres correcto',
            $status,
            sprintf('Esperado: %s, Actual: %s.', $this->getNamespace(), $namespace),
        );

        return $status->isOk();
    }
}
