<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\OtrMetodoPago;
use PhpCfdi\CeUtils\Tests\TestCase;

final class OtrMetodoPagoTest extends TestCase
{
    public OtrMetodoPago $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new OtrMetodoPago();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:OtrMetodoPago', $this->element->getElementName());
    }
}
