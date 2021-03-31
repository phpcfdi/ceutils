<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\CompExt;
use PhpCfdi\CeUtils\Tests\TestCase;

final class CompExtTest extends TestCase
{
    public CompExt $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new CompExt();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:CompExt', $this->element->getElementName());
    }
}
