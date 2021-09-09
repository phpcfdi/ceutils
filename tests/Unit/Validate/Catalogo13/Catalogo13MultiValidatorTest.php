<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Catalogo13;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Catalogo13\Base;
use PhpCfdi\CeUtils\Validate\Catalogo13\Catalogo13MultiValidator;

final class Catalogo13MultiValidatorTest extends TestCase
{
    public function testDefinition(): void
    {
        $multiValidator = new Catalogo13MultiValidator();
        $validators = $multiValidator->getValidatorClasses();
        $expected = [
            Base\DocumentDefinition::class,
            Base\DocumentFollowSchemas::class,
            Base\Certificate::class,
        ];
        $this->assertSame($expected, $validators);
    }
}
