<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\DifferentRfcTransaccionOtrMetodoPago;

final class DifferentRfcTransaccionOtrMetodoPagoTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = DifferentRfcTransaccionOtrMetodoPago::create();
        $this->assertInstanceOf(BaseDifferentRfc::class, $validator);
        $this->assertSame('PLZ13OTRPAGX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:OtrMetodoPago'], $validator->getPath());
    }
}
