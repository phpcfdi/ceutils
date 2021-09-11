<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

/**
 * Valida el atributo Moneda en Polizas/Poliza/Transaccion/OtrMetodoPago
 *
 * PLZ13OTRPAGCUR - La moneda se establece únicamente cuando el registro no es en moneda nacional
 * PLZ13OTRPAGCUR-NNN - La moneda solo se especifica en caso de que sea diferente a moneda nacional
 */
final class CurrencyTransaccionOtrMetodoPago extends BaseCurrency
{
    public static function create(): self
    {
        return new self('PLZ13OTRPAG', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:OtrMetodoPago');
    }
}
