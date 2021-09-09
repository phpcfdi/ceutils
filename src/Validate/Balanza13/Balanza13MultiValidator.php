<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

class Balanza13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
        FechaModificacionBalanza::class,
        CuentasSaldoFinal::class,
    ];
}
