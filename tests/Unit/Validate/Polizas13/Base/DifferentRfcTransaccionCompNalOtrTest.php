<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\DifferentRfcTransaccionCompNalOtr;

final class DifferentRfcTransaccionCompNalOtrTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = DifferentRfcTransaccionCompNalOtr::create();
        $this->assertInstanceOf(BaseDifferentRfc::class, $validator);
        $this->assertSame('PLZ13COMOTRRFCX', $validator->getAssertCode('X'));
        $this->assertSame(['PLZ:Poliza', 'PLZ:Transaccion', 'PLZ:CompNalOtr'], $validator->getPath());
    }
}
