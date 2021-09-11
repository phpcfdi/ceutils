<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\CurrencyDetAuxFolComprNal;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

final class CurrencyDetAuxFolComprNalTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = CurrencyDetAuxFolComprNal::create();
        $this->assertInstanceOf(BaseCurrency::class, $validator);
        $this->assertSame('AUXFOL13COMNALX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprNal'], $validator->getPath());
    }
}
