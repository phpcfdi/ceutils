<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\DifferentRfcDetAuxFolComprNalOtr;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

final class DifferentRfcDetAuxFolComprNalOtrTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = DifferentRfcDetAuxFolComprNalOtr::create();
        $this->assertInstanceOf(BaseDifferentRfc::class, $validator);
        $this->assertSame('AUXFOL13COMOTRX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprNalOtr'], $validator->getPath());
    }
}
