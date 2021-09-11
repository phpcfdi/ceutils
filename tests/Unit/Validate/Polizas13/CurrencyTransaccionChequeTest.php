<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\CurrencyTransaccionCheque;

final class CurrencyTransaccionChequeTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyTransaccionCheque::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('PLZ13CHEQUEX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Cheque'], $validator->getPath());
    }
}
