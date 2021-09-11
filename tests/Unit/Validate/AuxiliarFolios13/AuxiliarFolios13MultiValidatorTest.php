<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\AuxiliarFolios13MultiValidator;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

final class AuxiliarFolios13MultiValidatorTest extends TestCase
{
    public function testDefinition(): void
    {
        $multiValidator = new AuxiliarFolios13MultiValidator();
        $validators = $multiValidator->getValidatorClasses();
        $expected = [
            Base\DocumentDefinition::class,
            Base\DocumentFollowSchemas::class,
            Base\Certificate::class,
            Base\NumOrden::class,
            Base\NumTramite::class,
            Base\CurrencyDetAuxFolComprNal::class,
            Base\ExchangeRateDetAuxFolComprNal::class,
            Base\CurrencyDetAuxFolComprNalOtr::class,
            Base\ExchangeRateDetAuxFolComprNalOtr::class,
            Base\CurrencyDetAuxFolComprExt::class,
            Base\ExchangeRateDetAuxFolComprExt::class,
        ];
        $this->assertSame($expected, $validators);
    }
}
