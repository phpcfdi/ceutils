<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Catalogo13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

final class Catalogo13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
    ];
}
