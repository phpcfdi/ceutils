<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Balanza13;

use PhpCfdi\CeUtils\Elements\Balanza13\Balanza;
use PhpCfdi\CeUtils\Elements\Balanza13\Cuenta;
use PhpCfdi\CeUtils\Tests\TestCase;

final class BalanzaTest extends TestCase
{
    public Balanza $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Balanza();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('BCE:Balanza', $this->element->getElementName());
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

    public function testMultiCuenta()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCuenta(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('BCE:Ctas', 'id'));
    }
}
