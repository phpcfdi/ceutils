<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarCuentas13;

use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\DetalleAux;
use PhpCfdi\CeUtils\Tests\TestCase;

final class DetalleAuxTest extends TestCase
{
    public DetalleAux $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new DetalleAux();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('AuxiliarCtas:DetalleAux', $this->element->getElementName());
    }
}
