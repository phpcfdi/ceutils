<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit;

use PhpCfdi\CeUtils\AuxiliarFoliosCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class AuxiliarFoliosCreator13Test extends TestCase
{
    use WithFakeFiel;

    public function testCreateAuxiliarFoliosCreator13(): void
    {
        $attributes = [
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ];

        $creator = new AuxiliarFoliosCreator13($attributes);

        $reporteAuxiliarFolios = $creator->repAuxFol();

        $this->assertInstanceOf(AuxiliarFoliosCreator13::class, $creator);
        $this->assertEquals($reporteAuxiliarFolios->attributes()->get('Mes'), $attributes['Mes']);
        $this->assertEquals($reporteAuxiliarFolios->attributes()->get('Anio'), $attributes['Anio']);
        $this->assertEquals($reporteAuxiliarFolios->attributes()->get('TipoSolicitud'), $attributes['TipoSolicitud']);
        $this->assertEquals($reporteAuxiliarFolios->attributes()->get('NumTramite'), $attributes['NumTramite']);
    }

    public function testWhenPutSelloAddAttributes(): void
    {
        $fiel = $this->buildFiel();

        $creator = new AuxiliarFoliosCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $creator->addSello($fiel);

        $attributes = $creator->repAuxFol()->attributes()->exportArray();

        $this->assertArrayHasKey('RFC', $attributes);
        $this->assertArrayHasKey('noCertificado', $attributes);
        $this->assertArrayHasKey('Certificado', $attributes);
        $this->assertArrayHasKey('Sello', $attributes);
        $this->assertEquals($fiel->rfc(), $attributes['RFC']);
        $this->assertEquals($fiel->certificate()->serialNumber()->bytes(), $attributes['noCertificado']);
        $this->assertEquals($fiel->certificate()->pemAsOneLine(), $attributes['Certificado']);
        $this->assertNotEmpty($attributes['Sello']);
    }

    public function testConvertAuxiliarFoliosAsXml(): void
    {
        $fiel = $this->buildFiel();

        $creator = new AuxiliarFoliosCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $reporteAuxiliarFolios = $creator->repAuxFol();

        $detalleAuxiliarFolios = $reporteAuxiliarFolios->addDetalleAux([
            'NumUnIdenPol' => '194756',
            'Fecha' => '2021-03-25',
        ]);

        $detalleAuxiliarFolios->addComprNal([
            'UUID_CFDI' => 'fake uuid',
            'MontoTotal' => '100',
            'RFC' => 'fake rfc',
            'Moneda' => 'MXN',
        ]);

        $creator->addSello($fiel);

        $expectedSourceString = '||1.3|EKU9003173C9|01|2021|AF|123456|194756|2021-03-25|fake uuid|fake rfc|100|MXN||';
        $this->assertSame($expectedSourceString, $creator->buildCadenaDeOrigen());

        $expectedFile = __DIR__ . '/../_files/auxiliar-folios-sample.xml';
        $this->assertXmlStringEqualsXmlFile($expectedFile, $creator->asXml());
    }
}
