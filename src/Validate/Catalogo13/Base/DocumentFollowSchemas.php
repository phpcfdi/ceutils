<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Catalogo13\Base;

use PhpCfdi\CeUtils\Definitions\Catalogo13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentFollowSchemas;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * CAT13SCHEMA01 - El documento usa la ruta de la definición de esquema XML definido
 * CAT13SCHEMA02 - El documento cumple con la definición del esquema XML
 */
final class DocumentFollowSchemas extends BaseDocumentFollowSchemas
{
    public static function create(): self
    {
        return new self('CAT13SCHEMA', Catalogo13Definition::NAMESPACE, Catalogo13Definition::XSD_LOCATION);
    }
}
