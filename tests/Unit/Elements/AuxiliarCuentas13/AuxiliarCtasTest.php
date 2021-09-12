<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarCuentas13;

use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\AuxiliarCtas;
use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\Cuenta;
use PhpCfdi\CeUtils\Tests\TestCase;

final class AuxiliarCtasTest extends TestCase
{
    public AuxiliarCtas $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new AuxiliarCtas();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('AuxiliarCtas:AuxiliarCtas', $this->element->getElementName());
    }

    public function testAddCuenta(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addCuenta(['name' => 'FOO']);
        $this->assertInstanceOf(Cuenta::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addCuenta(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiCuenta(): void
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCuenta(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('AuxiliarCtas:Cuenta', 'id'));
    }
}
