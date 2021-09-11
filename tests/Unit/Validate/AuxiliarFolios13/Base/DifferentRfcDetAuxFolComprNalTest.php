<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\DifferentRfcDetAuxFolComprNal;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

final class DifferentRfcDetAuxFolComprNalTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = DifferentRfcDetAuxFolComprNal::create();
        $this->assertInstanceOf(BaseDifferentRfc::class, $validator);
        $this->assertSame('AUXFOL13COMNALX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprNal'], $validator->getPath());
    }
}
