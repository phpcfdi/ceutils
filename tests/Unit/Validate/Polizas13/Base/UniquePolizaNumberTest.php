<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseUniquePolizaNumber;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\UniquePolizaNumber;

final class UniquePolizaNumberTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = UniquePolizaNumber::create();
        $this->assertInstanceOf(BaseUniquePolizaNumber::class, $validator);
        $this->assertSame('PLZ13NUMUNIDENPOLX', $validator->getAssertCode('X'));
        $this->assertSame('PLZ:Poliza', $validator->getChildName());
    }
}
