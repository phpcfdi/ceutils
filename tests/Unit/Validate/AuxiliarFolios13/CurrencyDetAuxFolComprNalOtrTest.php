<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\CurrencyDetAuxFolComprNalOtr;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

final class CurrencyDetAuxFolComprNalOtrTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyDetAuxFolComprNalOtr::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('AUXFOL13COMOTRX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprNalOtr'], $validator->getPath());
    }
}
