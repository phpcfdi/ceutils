<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\UniquePolizaNumber;
use PhpCfdi\CeUtils\Validate\Common\BaseUniquePolizaNumber;

final class UniquePolizaNumberTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = UniquePolizaNumber::create();
        $this->assertInstanceOf(BaseUniquePolizaNumber::class, $validator);
        $this->assertSame('AUXFOL13NUMUNIDENPOLX', $validator->getAssertCode('X'));
        $this->assertSame('RepAux:DetAuxFol', $validator->getChildName());
    }
}
