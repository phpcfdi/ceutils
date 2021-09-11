<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\CurrencyDetAuxFolComprExt;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

final class CurrencyDetAuxFolComprExtTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyDetAuxFolComprExt::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('AUXFOL13COMEXTX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprExt'], $validator->getPath());
    }
}
