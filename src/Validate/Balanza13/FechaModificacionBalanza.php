<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

/**
 * BAL13FMB01 - Si el tipo de envío es complemento entonces la fecha de modificación de balanza debe existir
 */
final class FechaModificacionBalanza implements ValidatorInterface
{
    public static function create(): self
    {
        return new self();
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $assert = $asserts->put(
            'BAL13FMB01',
            'Si el tipo de envío es complemento entonces la fecha de modificación de balanza debe existir',
        );
        if ('C' === $root['TipoEnvio']) {
            $assert->setStatus(Status::when('' !== $root['FechaModBal']));
        }
    }
}
