<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseNumTramite;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\NumTramite;

final class NumTramiteTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = NumTramite::create();
        $this->assertInstanceOf(BaseNumTramite::class, $validator);
        $this->assertSame('PLZ13X', $validator->getAssertCode('X'));
    }
}
