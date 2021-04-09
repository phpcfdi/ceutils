<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13\Base;

use PhpCfdi\CeUtils\Definitions\Balanza13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentFollowSchemas;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * BAL13SCHEMA01 - El documento usa la ruta de la definición de esquema XML definido
 * BAL13SCHEMA02 - El documento cumple con la definición del esquema XML
 */
class DocumentFollowSchemas extends BaseDocumentFollowSchemas
{
    public static function create(): self
    {
        return new self('BAL13SCHEMA', Balanza13Definition::NAMESPACE, Balanza13Definition::XSD_LOCATION);
    }
}
