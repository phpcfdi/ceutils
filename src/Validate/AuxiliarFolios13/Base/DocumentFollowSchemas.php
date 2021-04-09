<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Definitions\AuxiliarFolios13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentFollowSchemas;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * AUXFOL13SCHEMA01 - El documento usa la ruta de la definición de esquema XML definido
 * AUXFOL13SCHEMA02 - El documento cumple con la definición del esquema XML
 */
class DocumentFollowSchemas extends BaseDocumentFollowSchemas
{
    public static function create(): self
    {
        return new self(
            'AUXFOL13SCHEMA',
            AuxiliarFolios13Definition::NAMESPACE,
            AuxiliarFolios13Definition::XSD_LOCATION
        );
    }
}
