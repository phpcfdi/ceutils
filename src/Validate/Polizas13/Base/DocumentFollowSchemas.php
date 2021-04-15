<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Definitions\Polizas13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentFollowSchemas;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * PLZ13SCHEMA01 - El documento usa la ruta de la definición de esquema XML definido
 * PLZ13SCHEMA02 - El documento cumple con la definición del esquema XML
 */
class DocumentFollowSchemas extends BaseDocumentFollowSchemas
{
    public static function create(): self
    {
        return new self('PLZ13SCHEMA', Polizas13Definition::NAMESPACE, Polizas13Definition::XSD_LOCATION);
    }
}
