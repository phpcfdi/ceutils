<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseUniquePolizaNumber;

/**
 * Valida el atributo NumUnIdenPol en Polizas/Poliza
 *
 * PLZ13NUMUNIDENPOL - En un mes ordinario no debe repetirse un mismo número de póliza
 * PLZ13NUMUNIDENPOL-NNN - En un mes ordinario no debe repetirse un mismo número de póliza
 */
final class UniquePolizaNumber extends BaseUniquePolizaNumber
{
    public static function create(): self
    {
        return new self('PLZ13NUMUNIDENPOL', 'PLZ:Poliza');
    }
}
