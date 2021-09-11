<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

/**
 * Valida el atributo Moneda en Polizas/Poliza/Transaccion/CompNalOtr
 *
 * PLZ13COMOTRCUR - La moneda se establece únicamente cuando el registro no es en moneda nacional
 * PLZ13COMOTRCUR-NNN - La moneda solo se especifica en caso de que sea diferente a moneda nacional
 */
final class CurrencyTransaccionCompNalOtr extends BaseCurrency
{
    public static function create(): self
    {
        return new self('PLZ13COMOTRCUR', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompNalOtr');
    }
}
