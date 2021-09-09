<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\CurrencyTransaccionCompNal;

final class CurrencyTransaccionCompNalTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyTransaccionCompNal::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('PLZ13COMNALX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompNal'], $validator->getPath());
    }
}
