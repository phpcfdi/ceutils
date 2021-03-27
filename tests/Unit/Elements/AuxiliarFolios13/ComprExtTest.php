<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\AuxiliarFolios13;

use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\ComprExt;
use PhpCfdi\CeUtils\Tests\TestCase;

final class ComprExtTest extends TestCase
{
    public ComprExt $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new ComprExt();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('RepAux:ComprExt', $this->element->getElementName());
    }
}
