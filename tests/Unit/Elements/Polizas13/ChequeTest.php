<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\Cheque;
use PhpCfdi\CeUtils\Tests\TestCase;

final class ChequeTest extends TestCase
{
    public Cheque $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Cheque();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:Cheque', $this->element->getElementName());
    }
}
