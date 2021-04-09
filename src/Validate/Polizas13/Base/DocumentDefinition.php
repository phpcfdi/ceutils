<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Definitions\Polizas13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentDefinition;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * PLZ13DOC01 - El documento tiene el nombre del nodo principal correcto
 * PLZ13DOC02 - El documento tiene el espacio de nombres correcto
 */
class DocumentDefinition extends BaseDocumentDefinition
{
    public static function create(): self
    {
        return new self('PLZ13DOC', Polizas13Definition::ELEMENT_NAME, Polizas13Definition::NAMESPACE);
    }
}
