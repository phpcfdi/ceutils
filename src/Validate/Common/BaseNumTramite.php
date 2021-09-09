<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Internal\AssertPrefixPropertyTrait;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

abstract class BaseNumTramite implements ValidatorInterface
{
    use AssertPrefixPropertyTrait;

    public function __construct(string $assertPrefix)
    {
        $this->assertPrefix = $assertPrefix;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $message = 'El número de trámite es requerido cuando el tipo de solicitud es Devolución o Compensación';
        $assert = $asserts->put($this->getAssertCode('NTR01'), $message);
        $tipoSolicitud = $root['TipoSolicitud'];
        if (in_array($tipoSolicitud, ['DE', 'CO'], true)) {
            $numTramite = $root['NumTramite'];
            $assert->setStatus(
                Status::when('' !== $numTramite),
                sprintf('TipoSolicitud: %s, Numtramite: %s', $tipoSolicitud, $numTramite)
            );
        }
    }
}
