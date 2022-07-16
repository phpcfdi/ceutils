<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Definitions\AuxiliarCuentas13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseDocumentDefinition;

/**
 * Valida el nombre del nodo principal y el espacio de nombres
 *
 * AUXCTA13DOC01 - El documento tiene el nombre del nodo principal correcto
 * AUXCTA13DOC02 - El documento tiene el espacio de nombres correcto
 */
class DocumentDefinition extends BaseDocumentDefinition
{
    public static function create(): self
    {
        return new self(
            'AUXCTA13DOC',
            AuxiliarCuentas13Definition::ELEMENT_NAME,
            AuxiliarCuentas13Definition::NAMESPACE,
        );
    }
}
