<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\NumOrden;

final class NumOrdenTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = NumOrden::create();
        $this->assertInstanceOf(BaseNumOrden::class, $validator);
        $this->assertSame('PLZ13NORX', $validator->getAssertCode('X'));
    }
}
