<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

/**
 * Valida el atributo Moneda en Polizas/Poliza/Transaccion/Transferencia
 *
 * PLZ13TRANSFERCUR - La moneda se establece únicamente cuando el registro no es en moneda nacional
 * PLZ13TRANSFERCUR-NNN - La moneda solo se especifica en caso de que sea diferente a moneda nacional
 */
final class CurrencyTransaccionTransferencia extends BaseCurrency
{
    public static function create(): self
    {
        return new self('PLZ13TRANSFERCUR', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Transferencia');
    }
}
