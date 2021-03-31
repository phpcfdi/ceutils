<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\Transferencia;
use PhpCfdi\CeUtils\Tests\TestCase;

final class TransferenciaTest extends TestCase
{
    public Transferencia $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Transferencia();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:Transferencia', $this->element->getElementName());
    }
}
