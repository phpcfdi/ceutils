<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13;

use PhpCfdi\CeUtils\Validate\MultiValidator;

final class Polizas13MultiValidator extends MultiValidator
{
    protected array $validatorClasses = [
        Base\DocumentDefinition::class,
        Base\DocumentFollowSchemas::class,
        Base\Certificate::class,
        Base\NumOrden::class,
        Base\NumTramite::class,
        Base\UniquePolizaNumber::class,
        Base\DifferentRfcTransaccionCompNal::class,
        Base\CurrencyTransaccionCompNal::class,
        Base\ExchangeRateTransaccionCompNal::class,
        Base\DifferentRfcTransaccionCompNalOtr::class,
        Base\CurrencyTransaccionCompNalOtr::class,
        Base\ExchangeRateTransaccionCompNalOtr::class,
        Base\CurrencyTransaccionCompExt::class,
        Base\ExchangeRateTransaccionCompExt::class,
        Base\DifferentRfcTransaccionCheque::class,
        Base\CurrencyTransaccionCheque::class,
        Base\ExchangeRateTransaccionCheque::class,
        Base\DifferentRfcTransaccionTransferencia::class,
        Base\CurrencyTransaccionTransferencia::class,
        Base\ExchangeRateTransaccionTransferencia::class,
        Base\DifferentRfcTransaccionOtrMetodoPago::class,
        Base\CurrencyTransaccionOtrMetodoPago::class,
        Base\ExchangeRateTransaccionOtrMetodoPago::class,
    ];
}
