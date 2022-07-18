<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Internal\AssertPrefixPropertyTrait;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

abstract class BaseNumOrden implements ValidatorInterface
{
    use AssertPrefixPropertyTrait;

    public function __construct(string $assertPrefix)
    {
        $this->assertPrefix = $assertPrefix;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $message = 'El número de orden es requerido cuando el tipo de solicitud'
            . ' es Acto de Fiscalización o Fiscalización Compulsa';
        $assert = $asserts->put($this->getAssertCode('01'), $message);
        $tipoSolicitud = $root['TipoSolicitud'];
        if (in_array($tipoSolicitud, ['AF', 'FC'], true)) {
            $numOrden = $root['NumOrden'];
            $assert->setStatus(
                Status::when('' !== $numOrden),
                sprintf('TipoSolicitud: %s, NumOrden: %s', $tipoSolicitud, $numOrden),
            );
        }
    }
}
