<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\ExchangeRateDetAuxFolComprExt;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

final class ExchangeRateDetAuxFolComprExtTest extends TestCase
{
    public function testDefinition(): void
    {
        $validator = ExchangeRateDetAuxFolComprExt::create();
        $this->assertInstanceOf(BaseExchangeRate::class, $validator);
        $this->assertSame('AUXFOL13COMEXTX', $validator->getAssertCode('X'));
        $this->assertSame(['RepAux:DetAuxFol', 'RepAux:ComprExt'], $validator->getPath());
    }
}
