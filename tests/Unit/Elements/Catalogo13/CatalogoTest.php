<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Catalogo13;

use PhpCfdi\CeUtils\Elements\Catalogo13\Catalogo;
use PhpCfdi\CeUtils\Elements\Catalogo13\Cuenta;
use PhpCfdi\CeUtils\Tests\TestCase;

final class CatalogoTest extends TestCase
{
    public Catalogo $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Catalogo();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('catalogocuentas:Catalogo', $this->element->getElementName());
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
        $this->assertSame('first', $node->searchAttribute('catalogocuentas:Ctas', 'id'));
    }
}
