<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarFolios13;

use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprNal;
use PhpCfdi\CeUtils\Tests\TestCase;

final class ComprNalTest extends TestCase
{
    public ComprNal $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new ComprNal();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('RepAux:ComprNal', $this->element->getElementName());
    }
}
