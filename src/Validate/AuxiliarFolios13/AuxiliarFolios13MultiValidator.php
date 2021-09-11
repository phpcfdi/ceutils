<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

class AuxiliarFolios13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
        Base\NumOrden::class,
        Base\NumTramite::class,
        Base\CurrencyDetAuxFolComprNal::class,
        Base\ExchangeRateDetAuxFolComprNal::class,
    ];
}
