<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit;

use PhpCfdi\CeUtils\AuxiliarCuentasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class AuxiliarCuentasCreator13Test extends TestCase
{
    use WithFakeFiel;

    public function testCreateAuxiliarCuentasCreator13(): void
    {
        $attributes = [
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ];

        $creator = new AuxiliarCuentasCreator13($attributes);

        $auxiliarCuentas = $creator->auxiliarCuentas();

        $this->assertInstanceOf(AuxiliarCuentasCreator13::class, $creator);
        $this->assertEquals($auxiliarCuentas->attributes()->get('Mes'), $attributes['Mes']);
        $this->assertEquals($auxiliarCuentas->attributes()->get('Anio'), $attributes['Anio']);
        $this->assertEquals($auxiliarCuentas->attributes()->get('TipoSolicitud'), $attributes['TipoSolicitud']);
        $this->assertEquals($auxiliarCuentas->attributes()->get('NumTramite'), $attributes['NumTramite']);
    }

    public function testWhenPutSelloAddAttributes(): void
    {
        $fiel = $this->buildFiel();

        $creator = new AuxiliarCuentasCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $creator->addSello($fiel);

        $attributes = $creator->auxiliarCuentas()->attributes()->exportArray();

        $this->assertArrayHasKey('RFC', $attributes);
        $this->assertArrayHasKey('noCertificado', $attributes);
        $this->assertArrayHasKey('Certificado', $attributes);
        $this->assertArrayHasKey('Sello', $attributes);
        $this->assertEquals($fiel->rfc(), $attributes['RFC']);
        $this->assertEquals($fiel->certificate()->serialNumber()->bytes(), $attributes['noCertificado']);
        $this->assertEquals($fiel->certificate()->pemAsOneLine(), $attributes['Certificado']);
        $this->assertNotEmpty($attributes['Sello']);
    }

    public function testConvertAuxiliarCuentasAsXml(): void
    {
        $fiel = $this->buildFiel();

        $creator = new AuxiliarCuentasCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $creator->addSello($fiel);

        $auxiliarCuentas = $creator->auxiliarCuentas();

        $cuenta = $auxiliarCuentas->addCuenta([
            'NumCta' => '602.01.01',
            'DesCta' => 'descripción',
            'SaldoIni' => '100.00',
            'SaldoFin' => '100.00',
        ]);

        $cuenta->multiDetalleAux(
            [
                'Fecha' => '2021-03-25',
                'NumUnIdenPol' => '123456',
                'Concepto' => 'concepto 1',
                'Debe' => '50',
                'Haber' => '0',
            ],
            [
                'Fecha' => '2021-03-25',
                'NumUnIdenPol' => '123456',
                'Concepto' => 'concepto 2',
                'Debe' => '50',
                'Haber' => '0',
            ]
        );

        $expectedFile = __DIR__ . '/../_files/auxiliar-cuentas-sample.xml';
        $this->assertXmlStringEqualsXmlFile($expectedFile, $creator->asXml());
    }
}
