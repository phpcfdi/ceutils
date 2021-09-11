<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseUniquePolizaNumber;

/**
 * Valida el atributo NumUnIdenPol en RepAuxFol/DetAuxFol
 *
 * AUXFOL13NUMUNIDENPOL - En un mes ordinario no debe repetirse un mismo número de póliza
 * AUXFOL13NUMUNIDENPOL-NNN - En un mes ordinario no debe repetirse un mismo número de póliza
 */
final class UniquePolizaNumber extends BaseUniquePolizaNumber
{
    public static function create(): self
    {
        return new self('AUXFOL13NUMUNIDENPOL', 'RepAux:DetAuxFol');
    }
}
