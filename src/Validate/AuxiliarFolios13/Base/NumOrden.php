<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;

/**
 * Valida el atributo NumOrden en relación con el atributo TipoSolicitud (AF o FC)
 *
 * AUXFOL13NOR01 - El número de orden es requerido cuando el tipo de solicitud
 *                 es Acto de Fiscalización o Fiscalización Compulsa
 */
class NumOrden extends BaseNumOrden
{
    public static function create(): self
    {
        return new self('AUXFOL13');
    }
}
