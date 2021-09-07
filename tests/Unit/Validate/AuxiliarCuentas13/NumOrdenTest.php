<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\AuxiliarCuentasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarCuentas13\Base\NumOrden;

final class NumOrdenTest extends TestCase
{
    public function providerTipoSolicitudApplyWithNumOrden(): array
    {
        return [
            'TipoSolicitud[AF]' => ['AF'],
            'TipoSolicitud[FC]' => ['FC'],
        ];
    }

    /** @dataProvider providerTipoSolicitudApplyWithNumOrden */
    public function testTipoSolicitudApplyWithNumOrden(string $tipoSolicitud): void
    {
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => 'XXX1234567/89',
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NOR01')->getStatus()->isOk());
    }

    public function providerTipoSolicitudApplyWithEmptyNumOrden(): array
    {
        return [
            'TipoSolicitud[AF]' => ['AF'],
            'TipoSolicitud[FC]' => ['FC'],
        ];
    }

    /** @dataProvider providerTipoSolicitudApplyWithNumOrden */
    public function testTipoSolicitudApplyWithEmptyNumOrden(string $tipoSolicitud): void
    {
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => '',
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NOR01')->getStatus()->isError());
    }

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
        $auxiliarCuentas = (new AuxiliarCuentasCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => $numOrden,
        ]))->auxiliarCuentas();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($auxiliarCuentas, $asserts);

        $this->assertTrue($asserts->get('AUXCTA13NOR01')->getStatus()->isNone());
    }
}
