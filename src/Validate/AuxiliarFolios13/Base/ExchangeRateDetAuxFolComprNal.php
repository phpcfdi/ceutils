<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

/**
 * Valida el atributo TipCamb en RepAuxFol/DetAuxFol/ComprNal
 *
 * AUXFOL13COMNALEXR - El tipo de cambio se establece únicamente cuando el registro no es en moneda nacional
 * AUXFOL13COMNALEXR-NNN - El tipo de cambio debe tener un valor en caso de que la moneda sea diferente
 *                         a moneda nacional
 */
final class ExchangeRateDetAuxFolComprNal extends BaseExchangeRate
{
    public static function create(): self
    {
        return new self('AUXFOL13COMNAL', 'RepAux:DetAuxFol', 'RepAux:ComprNal');
    }
}
