<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13\Base;

use PhpCfdi\CeUtils\Definitions\Balanza13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentDefinition;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * BAL13DOC01 - El documento tiene el nombre del nodo principal correcto
 * BAL13DOC02 - El documento tiene el espacio de nombres correcto
 */
class DocumentDefinition extends BaseDocumentDefinition
{
    public static function create(): self
    {
        return new self('BAL13DOC', Balanza13Definition::ELEMENT_NAME, Balanza13Definition::NAMESPACE);
    }
}
