<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base\NumOrden;
use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;

final class NumOrdenTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = NumOrden::create();
        $this->assertInstanceOf(BaseNumOrden::class, $validator);
        $this->assertSame('AUXCTA13X', $validator->getAssertCode('X'));
    }
}
