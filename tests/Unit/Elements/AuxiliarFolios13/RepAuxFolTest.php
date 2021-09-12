<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarFolios13;

use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\DetAuxFol;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\RepAuxFol;
use PhpCfdi\CeUtils\Tests\TestCase;

final class RepAuxFolTest extends TestCase
{
    public RepAuxFol $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new RepAuxFol();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('RepAux:RepAuxFol', $this->element->getElementName());
    }

    public function testAddDetalleAux(): void
    {
        $parent = $this->element;
        $this->assertCount(0, $parent);

        $first = $parent->addDetalleAux(['id' => 'first']);
        $this->assertCount(1, $parent);
        $this->assertInstanceOf(DetAuxFol::class, $first);
        $this->assertSame('first', $parent->searchAttribute('RepAux:DetAuxFol', 'id'));

        $second = $parent->addDetalleAux(['ID' => 'BAR']);
        $this->assertNotSame($first, $second);
        $this->assertCount(2, $this->element);
    }

    public function testMultiDetalleAux(): void
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiDetalleAux(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('RepAux:DetAuxFol', 'id'));
    }
}
