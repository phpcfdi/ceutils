<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\AuxiliarCuentasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base\NumTramite;

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
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => 'XX123456789012',
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NTR01')->getStatus()->isOk());
    }

    /** @dataProvider providerTipoSolicitudApply */
    public function testTipoSolicitudApplyWithEmptyNumTramite(string $tipoSolicitud): void
    {
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => '',
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NTR01')->getStatus()->isError());
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
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => $numTramite,
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NTR01')->getStatus()->isNone());
    }
}
