<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Elements\Polizas13;

use PhpCfdi\CeUtils\Elements\Polizas13\Cheque;
use PhpCfdi\CeUtils\Elements\Polizas13\CompExt;
use PhpCfdi\CeUtils\Elements\Polizas13\CompNal;
use PhpCfdi\CeUtils\Elements\Polizas13\CompNalOtr;
use PhpCfdi\CeUtils\Elements\Polizas13\OtrMetodoPago;
use PhpCfdi\CeUtils\Elements\Polizas13\Transaccion;
use PhpCfdi\CeUtils\Elements\Polizas13\Transferencia;
use PhpCfdi\CeUtils\Tests\TestCase;

final class TransaccionTest extends TestCase
{
    public Transaccion $element;

    protected function setUp(): void
    {
        parent::setUp();
        $this->element = new Transaccion();
    }

    public function testGetElementName(): void
    {
        $this->assertSame('PLZ:Transaccion', $this->element->getElementName());
    }

    public function testAddCompNal(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addCompNal(['name' => 'FOO']);
        $this->assertInstanceOf(CompNal::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addCompNal(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiCompNal()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCompNal(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:CompNal', 'id'));
    }

    public function testAddCompNalOtr(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addCompNalOtr(['name' => 'FOO']);
        $this->assertInstanceOf(CompNalOtr::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addCompNalOtr(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiCompNalOtr()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCompNalOtr(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:CompNalOtr', 'id'));
    }

    public function testAddCompExt(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addCompExt(['name' => 'FOO']);
        $this->assertInstanceOf(CompExt::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addCompExt(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiCompExt()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCompExt(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:CompExt', 'id'));
    }

    public function testAddCheque(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addCheque(['name' => 'FOO']);
        $this->assertInstanceOf(Cheque::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addCheque(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiCheque()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiCheque(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:Cheque', 'id'));
    }

    public function testAddTransferencia(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addTransferencia(['name' => 'FOO']);
        $this->assertInstanceOf(Transferencia::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addTransferencia(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiTransferencia()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiTransferencia(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:Transferencia', 'id'));
    }

    public function testAddOtrMetodoPago(): void
    {
        // no childs
        $this->assertCount(0, $this->element);

        $first = $this->element->addOtrMetodoPago(['name' => 'FOO']);
        $this->assertInstanceOf(OtrMetodoPago::class, $first);
        $this->assertSame('FOO', $first['name']);
        $this->assertCount(1, $this->element);

        $second = $this->element->addOtrMetodoPago(['name' => 'FOO']);
        $this->assertCount(2, $this->element);

        // test that first and second are not the same
        $this->assertNotSame($first, $second);
    }

    public function testMultiOtrMetodoPago()
    {
        $node = $this->element;
        $this->assertCount(0, $node);
        $multiReturn = $node->multiOtrMetodoPago(
            ['id' => 'first'],
            ['id' => 'second']
        );
        $this->assertSame($multiReturn, $node);
        $this->assertCount(2, $node);
        $this->assertSame('first', $node->searchAttribute('PLZ:OtrMetodoPago', 'id'));
    }
}
