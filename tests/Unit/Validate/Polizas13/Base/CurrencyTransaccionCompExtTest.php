<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\CurrencyTransaccionCompExt;

final class CurrencyTransaccionCompExtTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyTransaccionCompExt::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('PLZ13COMEXTCURX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompExt'], $validator->getPath());
    }
}
