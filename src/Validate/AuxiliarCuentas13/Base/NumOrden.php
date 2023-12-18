<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;

/**
 * Valida el atributo NumOrden en relación con el atributo TipoSolicitud (AF o FC)
 *
 * AUXCTANOR01 - El número de orden es requerido cuando el tipo de solicitud
 *                 es Acto de Fiscalización o Fiscalización Compulsa
 */
final class NumOrden extends BaseNumOrden
{
    public static function create(): self
    {
        return new self('AUXCTA13NOR');
    }
}
