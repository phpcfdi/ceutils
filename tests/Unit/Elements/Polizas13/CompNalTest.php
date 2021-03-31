<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\CompNal;
use PhpCfdi\CeUtils\Tests\TestCase;

final class CompNalTest extends TestCase
{
    public CompNal $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new CompNal();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:CompNal', $this->element->getElementName());
    }
}
