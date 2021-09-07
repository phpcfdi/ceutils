<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\AuxiliarFoliosCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\NumOrden;

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
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => 'XXX1234567/89',
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NOR01')->getStatus()->isOk());
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
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => '',
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NOR01')->getStatus()->isError());
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
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumOrden' => $numOrden,
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumOrden::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NOR01')->getStatus()->isNone());
    }
}
