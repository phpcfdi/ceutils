<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\AuxiliarCuentas13MultiValidator;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base;

final class AuxiliarCuentas13MultiValidatorTest extends TestCase
{
    public function testDefinition(): void
    {
        $multiValidator = new AuxiliarCuentas13MultiValidator();
        $validators = $multiValidator->getValidatorClasses();
        $expected = [
            Base\DocumentDefinition::class,
            Base\DocumentFollowSchemas::class,
            Base\Certificate::class,
            Base\NumOrden::class,
            Base\NumTramite::class,
        ];
        $this->assertSame($expected, $validators);
    }
}
