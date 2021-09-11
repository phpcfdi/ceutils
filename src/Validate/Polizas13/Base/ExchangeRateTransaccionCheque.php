<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

/**
 * Valida el atributo TipCamb en Polizas/Poliza/Transaccion/Cheque
 *
 * PLZ13CHEQUEEXR - El tipo de cambio se establece únicamente cuando el registro no es en moneda nacional
 * PLZ13CHEQUEEXR-NNN - El tipo de cambio debe tener un valor en caso de que la moneda sea diferente a moneda nacional
 */
final class ExchangeRateTransaccionCheque extends BaseExchangeRate
{
    public static function create(): self
    {
        return new self('PLZ13CHEQUE', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Cheque');
    }
}
