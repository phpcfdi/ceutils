<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

/**
 * Valida el atributo TipCamb en RepAuxFol/DetAuxFol/ComprExt
 *
 * AUXFOL13COMEXTEXR - El tipo de cambio se establece únicamente cuando el registro no es en moneda nacional
 * AUXFOL13COMEXTEXR-NNN - El tipo de cambio debe tener un valor en caso de que la moneda sea diferente
 *                         a moneda nacional
 */
final class ExchangeRateDetAuxFolComprExt extends BaseExchangeRate
{
    public static function create(): self
    {
        return new self('AUXFOL13COMEXT', 'RepAux:DetAuxFol', 'RepAux:ComprExt');
    }
}
