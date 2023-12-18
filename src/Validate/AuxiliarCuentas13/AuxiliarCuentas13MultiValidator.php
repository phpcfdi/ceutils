<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarCuentas13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

final class AuxiliarCuentas13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
        Base\NumOrden::class,
        Base\NumTramite::class,
    ];
}
