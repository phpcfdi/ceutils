<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

/**
 * Valida el atributo RFC en Polizas/Poliza/Transaccion/OtrMetodoPago
 *
 * PLZ13OTRPAGRFC - Los RFC de la información detallada deben ser distintos al RFC del emisor
 * PLZ13OTRPAGRFC-NNN - El RFC de referencia debe ser distinto al registro del que envía los datos
 */
final class DifferentRfcTransaccionOtrMetodoPago extends BaseDifferentRfc
{
    public static function create(): self
    {
        return new self('PLZ13OTRPAGRFC', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:OtrMetodoPago');
    }
}
