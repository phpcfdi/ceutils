<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseNumTramite;

final class BaseNumTramiteTest extends TestCase
{
    /** @var BaseNumTramite */
    private $validator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validator = new class('PREFIX') extends BaseNumTramite {
            public static function create(): self
            {
                throw new LogicException("Static method won't be tested");
            }
        };
    }

    public function providerTipoSolicitudApply(): array
    {
        return [
            'TipoSolicitud[DE]' => ['DE'],
            'TipoSolicitud[CO]' => ['CO'],
        ];
    }

    /** @dataProvider providerTipoSolicitudApply */
    public function testTipoSolicitudApplyWithNumTramite(string $tipoSolicitud): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => 'XX123456789012',
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNTR01')->getStatus()->isOk());
    }

    /** @dataProvider providerTipoSolicitudApply */
    public function testTipoSolicitudApplyWithEmptyNumTramite(string $tipoSolicitud): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => '',
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNTR01')->getStatus()->isError());
    }

    public function providerTipoSolicitudNotApply(): array
    {
        return [
            'TipoSolicitud[empty] NumTramite[empty]' => ['', ''],
            'TipoSolicitud[AF] NumTramite[empty]' => ['AF', ''],
            'TipoSolicitud[AF] NumTramite[value]' => ['AF', 'XX123456789012'],
            'TipoSolicitud[FC] NumTramite[empty]' => ['FC', ''],
            'TipoSolicitud[FC] NumTramite[value]' => ['FC', 'XX123456789012'],
        ];
    }

    /** @dataProvider providerTipoSolicitudNotApply */
    public function testTipoSolicitudNotApply(string $tipoSolicitud, string $numTramite): void
    {
        $node = new Node('name', [
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => $numTramite,
        ]);

        $asserts = new Asserts();
        $this->validator->validate($node, $asserts);

        $this->assertTrue($asserts->get('PREFIXNTR01')->getStatus()->isNone());
    }
}
