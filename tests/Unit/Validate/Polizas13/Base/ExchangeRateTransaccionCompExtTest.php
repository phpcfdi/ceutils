<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\ExchangeRateTransaccionCompExt;

final class ExchangeRateTransaccionCompExtTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = ExchangeRateTransaccionCompExt::create();
        $this->assertInstanceOf(BaseExchangeRate::class, $validator);
        $this->assertSame('PLZ13COMEXTX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompExt'], $validator->getPath());
    }
}
