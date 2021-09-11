<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Polizas13\Base;
use PhpCfdi\CeUtils\Validate\Polizas13\Polizas13MultiValidator;

final class Polizas13MultiValidatorTest extends TestCase
{
    public function testDefinition(): void
    {
        $multiValidator = new Polizas13MultiValidator();
        $validators = $multiValidator->getValidatorClasses();
        $expected = [
            Base\DocumentDefinition::class,
            Base\DocumentFollowSchemas::class,
            Base\Certificate::class,
            Base\NumOrden::class,
            Base\NumTramite::class,
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
            Base\CurrencyTransaccionTransferencia::class,
            Base\ExchangeRateTransaccionTransferencia::class,
            Base\CurrencyTransaccionOtrMetodoPago::class,
            Base\ExchangeRateTransaccionOtrMetodoPago::class,
        ];
        $this->assertSame($expected, $validators);
    }
}
