<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseNumOrden;

final class BaseNumOrdenTest extends TestCase
{
    private BaseNumOrden $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new class('PREFIX') extends BaseNumOrden {
            public static function create(): void
            {
                throw new LogicException("Static method won't be tested");
            }
        };
    }

    /** @return array<string, array<string>> */
    public function providerTipoSolicitudThatRequireNumOrden(): array
    {
        return [
            'TipoSolicitud[AF]' => ['AF'],
            'TipoSolicitud[FC]' => ['FC'],
        ];
    }

    /** @dataProvider providerTipoSolicitudThatRequireNumOrden */
    public function testTipoSolicitudApplyWithNumOrden(string $tipoSolicitud): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => 'XXX1234567/89',
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNOR01')->getStatus()->isOk());
    }

    /** @dataProvider providerTipoSolicitudThatRequireNumOrden */
    public function testTipoSolicitudApplyWithEmptyNumOrden(string $tipoSolicitud): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => '',
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNOR01')->getStatus()->isError());
    }

    /** @return array<string, array<string>> */
    public function providerTipoSolicitudNotApply(): array
    {
        return [
            'TipoSolicitud[empty] NumOrden[empty]' => ['', ''],
            'TipoSolicitud[DE] NumOrden[empty]' => ['DE', ''],
            'TipoSolicitud[DE] NumOrden[value]' => ['DE', 'XXX1234567/89'],
            'TipoSolicitud[CO] NumOrden[empty]' => ['DE', ''],
            'TipoSolicitud[CO] NumOrden[value]' => ['CO', 'XXX1234567/89'],
        ];
    }

    /** @dataProvider providerTipoSolicitudNotApply */
    public function testTipoSolicitudNotApply(string $tipoSolicitud, string $numOrden): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => $numOrden,
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNOR01')->getStatus()->isNone());
    }
}
