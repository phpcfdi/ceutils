<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\ExchangeRateTransaccionCompNal;

final class ExchangeRateTransaccionCompNalTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = ExchangeRateTransaccionCompNal::create();
        $this->assertInstanceOf(BaseExchangeRate::class, $validator);
        $this->assertSame('PLZ13COMNALX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompNal'], $validator->getPath());
    }
}
