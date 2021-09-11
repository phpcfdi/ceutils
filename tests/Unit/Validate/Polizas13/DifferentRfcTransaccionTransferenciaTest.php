<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\DifferentRfcTransaccionTransferencia;

final class DifferentRfcTransaccionTransferenciaTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = DifferentRfcTransaccionTransferencia::create();
        $this->assertInstanceOf(BaseDifferentRfc::class, $validator);
        $this->assertSame('PLZ13TRANSFERX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:Transferencia'], $validator->getPath());
    }
}
