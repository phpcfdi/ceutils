<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\NumOrden;
use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;

final class NumOrdenTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = NumOrden::create();
        $this->assertInstanceOf(BaseNumOrden::class, $validator);
        $this->assertSame('AUXFOL13NORX', $validator->getAssertCode('X'));
    }
}
