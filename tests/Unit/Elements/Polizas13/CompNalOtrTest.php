<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\CompNalOtr;
use PhpCfdi\CeUtils\Tests\TestCase;

final class CompNalOtrTest extends TestCase
{
    public CompNalOtr $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new CompNalOtr();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:CompNalOtr', $this->element->getElementName());
    }
}
