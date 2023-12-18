<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseNumTramite;

/**
 * Valida el atributo NumTramite en relación con el atributo TipoSolicitud (DE o CO)
 *
 * PLZ13NTR01 - El número de trámite es requerido cuando el tipo de solicitud es Devolución o Compensación
 */
final class NumTramite extends BaseNumTramite
{
    public static function create(): self
    {
        return new self('PLZ13NTR');
    }
}
