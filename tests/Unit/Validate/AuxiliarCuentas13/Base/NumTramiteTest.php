<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base\NumTramite;
use PhpCfdi\CeUtils\Validate\Common\BaseNumTramite;

final class NumTramiteTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = NumTramite::create();
        $this->assertInstanceOf(BaseNumTramite::class, $validator);
        $this->assertSame('AUXCTA13NTRX', $validator->getAssertCode('X'));
    }
}
