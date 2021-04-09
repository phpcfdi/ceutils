<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Definitions\AuxiliarFolios13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentDefinition;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * AUXFOL13DOC01 - El documento tiene el nombre del nodo principal correcto
 * AUXFOL13DOC02 - El documento tiene el espacio de nombres correcto
 */
class DocumentDefinition extends BaseDocumentDefinition
{
    public static function create(): self
    {
        return new self(
            'AUXFOL13DOC',
            AuxiliarFolios13Definition::ELEMENT_NAME,
            AuxiliarFolios13Definition::NAMESPACE
        );
    }
}
