<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseNumTramite;

/**
 * Valida el atributo NumTramite en relación con el atributo TipoSolicitud (DE o CO)
 *
 * AUXCTA13NTR01 - El número de trámite es requerido cuando el tipo de solicitud es Devolución o Compensación
 */
class NumTramite extends BaseNumTramite
{
    public static function create(): self
    {
        return new self('AUXCTA13');
    }
}
