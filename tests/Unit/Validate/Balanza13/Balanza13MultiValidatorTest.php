<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Balanza13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Balanza13\Balanza13MultiValidator;
use PhpCfdi\CeUtils\Validate\Balanza13\Base;
use PhpCfdi\CeUtils\Validate\Balanza13\CuentasSaldoFinal;
use PhpCfdi\CeUtils\Validate\Balanza13\FechaModificacionBalanza;

final class Balanza13MultiValidatorTest extends TestCase
{
    public function testDefinition(): void
    {
        $multiValidator = new Balanza13MultiValidator();
        $validators = $multiValidator->getValidatorClasses();
        $expected = [
            Base\DocumentDefinition::class,
            Base\DocumentFollowSchemas::class,
            Base\Certificate::class,
            FechaModificacionBalanza::class,
            CuentasSaldoFinal::class,
        ];
        $this->assertSame($expected, $validators);
    }
}
