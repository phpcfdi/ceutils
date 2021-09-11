<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\ExchangeRateDetAuxFolComprNal;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

final class ExchangeRateDetAuxFolComprNalTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = ExchangeRateDetAuxFolComprNal::create();
        $this->assertInstanceOf(BaseExchangeRate::class, $validator);
        $this->assertSame('AUXFOL13COMNALX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprNal'], $validator->getPath());
    }
}
