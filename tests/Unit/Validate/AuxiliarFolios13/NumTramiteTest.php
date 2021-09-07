<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\AuxiliarFoliosCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base\NumTramite;

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
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => 'XX123456789012',
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NTR01')->getStatus()->isOk());
    }

    /** @dataProvider providerTipoSolicitudApply */
    public function testTipoSolicitudApplyWithEmptyNumTramite(string $tipoSolicitud): void
    {
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => '',
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NTR01')->getStatus()->isError());
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
        $repAuxFol = (new AuxiliarFoliosCreator13([
            'TipoSolicitud' => $tipoSolicitud,
            'NumTramite' => $numTramite,
        ]))->repAuxFol();

        $asserts = new Asserts();
        $validator = NumTramite::create();
        $validator->validate($repAuxFol, $asserts);

        $this->assertTrue($asserts->get('AUXFOL13NTR01')->getStatus()->isNone());
    }
}
