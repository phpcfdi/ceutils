<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\Poliza;
use PhpCfdi\CeUtils\Elements\Polizas13\Polizas;
use PhpCfdi\CeUtils\Tests\TestCase;

final class PolizasTest extends TestCase
{
    public Polizas $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Polizas();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:Polizas', $this->element->getElementName());
    }

    public function testAddPoliza(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addPoliza(['name' => 'FOO']);
        $this->assertInstanceOf(Poliza::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addPoliza(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiPoliza(): void
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiPoliza(
            ['id' => 'first'],
            ['id' => 'second'],
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:Poliza', 'id'));
    }
}
