<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Balanza13;

use PhpCfdi\CeUtils\Elements\Balanza13\Cuenta;
use PhpCfdi\CeUtils\Tests\TestCase;

final class CuentaTest extends TestCase
{
    public Cuenta $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Cuenta();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('BCE:Ctas', $this->element->getElementName());
    }
}
