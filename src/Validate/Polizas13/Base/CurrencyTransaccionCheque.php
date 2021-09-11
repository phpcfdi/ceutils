<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

/**
 * Valida el atributo Moneda en Polizas/Poliza/Transaccion/Cheque
 *
 * PLZ13CHEQUECUR - La moneda se establece únicamente cuando el registro no es en moneda nacional
 * PLZ13CHEQUECUR-NNN - La moneda solo se especifica en caso de que sea diferente a moneda nacional
 */
final class CurrencyTransaccionCheque extends BaseCurrency
{
    public static function create(): self
    {
        return new self('PLZ13CHEQUE', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Cheque');
    }
}
