<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarCuentas13;

use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\Cuenta;
use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\DetalleAux;
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
        $this->assertSame('AuxiliarCtas:Cuenta', $this->element->getElementName());
    }

    public function testAddDetalleAux(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addDetalleAux(['name' => 'FOO']);
        $this->assertInstanceOf(DetalleAux::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addDetalleAux(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiDetalleAux()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiDetalleAux(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('AuxiliarCtas:DetalleAux', 'id'));
    }
}
