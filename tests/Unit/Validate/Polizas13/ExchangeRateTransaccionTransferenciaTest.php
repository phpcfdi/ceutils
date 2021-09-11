<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\ExchangeRateTransaccionTransferencia;

final class ExchangeRateTransaccionTransferenciaTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = ExchangeRateTransaccionTransferencia::create();
        $this->assertInstanceOf(BaseExchangeRate::class, $validator);
        $this->assertSame('PLZ13TRANSFERX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Transferencia'], $validator->getPath());
    }
}
