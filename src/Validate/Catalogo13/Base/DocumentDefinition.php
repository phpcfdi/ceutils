<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Catalogo13\Base;

use PhpCfdi\CeUtils\Definitions\Catalogo13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentDefinition;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * CAT13DOC01 - El documento tiene el nombre del nodo principal correcto
 * CAT13DOC02 - El documento tiene el espacio de nombres correcto
 */
final class DocumentDefinition extends BaseDocumentDefinition
{
    public static function create(): self
    {
        return new self('CAT13DOC', Catalogo13Definition::ELEMENT_NAME, Catalogo13Definition::NAMESPACE);
    }
}
