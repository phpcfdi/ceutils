<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

/**
 * Valida el atributo RFC en Polizas/Poliza/Transaccion/Cheque
 *
 * PLZ13CHEQUERFC - Los RFC de la información detallada deben ser distintos al RFC del emisor
 * PLZ13CHEQUERFC-NNN - El RFC de referencia debe ser distinto al registro del que envía los datos
 */
final class DifferentRfcTransaccionCheque extends BaseDifferentRfc
{
    public static function create(): self
    {
        return new self('PLZ13CHEQUERFC', 'PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Cheque');
    }
}
