<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

class Polizas13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
        Base\NumOrden::class,
        Base\NumTramite::class,
        Base\CurrencyTransaccionCompNal::class,
        Base\ExchangeRateTransaccionCompNal::class,
        Base\CurrencyTransaccionCompNalOtr::class,
        Base\ExchangeRateTransaccionCompNalOtr::class,
        Base\CurrencyTransaccionCompExt::class,
        Base\ExchangeRateTransaccionCompExt::class,
        Base\CurrencyTransaccionCheque::class,
        Base\ExchangeRateTransaccionCheque::class,
    ];
}
