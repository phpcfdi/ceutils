<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarFolios13;

use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprNalOtr;
use PhpCfdi\CeUtils\Tests\TestCase;

final class ComprNalOtrTest extends TestCase
{
    public ComprNalOtr $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new ComprNalOtr();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('RepAux:ComprNalOtr', $this->element->getElementName());
    }
}
