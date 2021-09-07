<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\PolizasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Polizas13\Base\NumTramite;

final class NumTramiteTest extends TestCase
{
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
        $polizas = (new PolizasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => 'XX123456789012',
        ]))->polizas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($polizas, $asserts);

        $this->assertTrue($asserts->get('PLZ13NTR01')->getStatus()->isOk());
    }

    /** @dataProvider providerTipoSolicitudApply */
    public function testTipoSolicitudApplyWithEmptyNumTramite(string $tipoSolicitud): void
    {
        $polizas = (new PolizasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => '',
        ]))->polizas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($polizas, $asserts);

        $this->assertTrue($asserts->get('PLZ13NTR01')->getStatus()->isError());
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
        $polizas = (new PolizasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => $numTramite,
        ]))->polizas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($polizas, $asserts);

        $this->assertTrue($asserts->get('PLZ13NTR01')->getStatus()->isNone());
    }
}
