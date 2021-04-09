<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Definitions\AuxiliarCuentas13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentFollowSchemas;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * AUXCTA13SCHEMA01 - El documento usa la ruta de la definición de esquema XML definido
 * AUXCTA13SCHEMA02 - El documento cumple con la definición del esquema XML
 */
class DocumentFollowSchemas extends BaseDocumentFollowSchemas
{
    public static function create(): self
    {
        return new self(
            'AUXCTA13SCHEMA',
            AuxiliarCuentas13Definition::NAMESPACE,
            AuxiliarCuentas13Definition::XSD_LOCATION
        );
    }
}
