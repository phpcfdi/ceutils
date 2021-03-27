<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarFolios13;

use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprExt;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprNal;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprNalOtr;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\DetAuxFol;
use PhpCfdi\CeUtils\Tests\TestCase;

final class DetAuxFolTest extends TestCase
{
    public DetAuxFol $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new DetAuxFol();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('RepAux:DetAuxFol', $this->element->getElementName());
    }

    public function testAddComprNal()
    {
        $parent = $this->element;
        $this->assertCount(0, $parent);

        $first = $parent->addComprNal(['id' => 'first']);
        $this->assertCount(1, $parent);
        $this->assertInstanceOf(ComprNal::class, $first);
        $this->assertSame('first', $parent->searchAttribute('RepAux:ComprNal', 'id'));

        $second = $parent->addComprNal(['ID' => 'BAR']);
        $this->assertNotSame($first, $second);
        $this->assertCount(2, $this->element);
    }

    public function testMultiComprNal()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiComprNal(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('RepAux:ComprNal', 'id'));
    }

    public function testAddComprNalOtr()
    {
        $parent = $this->element;
        $this->assertCount(0, $parent);

        $first = $parent->addComprNalOtr(['id' => 'first']);
        $this->assertCount(1, $parent);
        $this->assertInstanceOf(ComprNalOtr::class, $first);
        $this->assertSame('first', $parent->searchAttribute('RepAux:ComprNalOtr', 'id'));

        $second = $parent->addComprNalOtr(['ID' => 'BAR']);
        $this->assertNotSame($first, $second);
        $this->assertCount(2, $this->element);
    }

    public function testMultiComprNalOtr()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiComprNalOtr(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('RepAux:ComprNalOtr', 'id'));
    }

    public function testAddComprExt()
    {
        $parent = $this->element;
        $this->assertCount(0, $parent);

        $first = $parent->addComprExt(['id' => 'first']);
        $this->assertCount(1, $parent);
        $this->assertInstanceOf(ComprExt::class, $first);
        $this->assertSame('first', $parent->searchAttribute('RepAux:ComprExt', 'id'));

        $second = $parent->addComprExt(['ID' => 'BAR']);
        $this->assertNotSame($first, $second);
        $this->assertCount(2, $this->element);
    }

    public function testMultiComprExt()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiComprExt(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('RepAux:ComprExt', 'id'));
    }
}
