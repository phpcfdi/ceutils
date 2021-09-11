<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

/**
 * Valida el atributo Moneda en RepAuxFol/DetAuxFol/ComprExt
 *
 * AUXFOL13COMEXTCUR - La moneda se establece únicamente cuando el registro no es en moneda nacional
 * AUXFOL13COMEXTCUR-NNN - La moneda solo se especifica en caso de que sea diferente a moneda nacional
 */
final class CurrencyDetAuxFolComprExt extends BaseCurrency
{
    public static function create(): self
    {
        return new self('AUXFOL13COMEXTCUR', 'RepAux:DetAuxFol', 'RepAux:ComprExt');
    }
}
