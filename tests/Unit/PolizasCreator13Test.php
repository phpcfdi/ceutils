<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit;

use PhpCfdi\CeUtils\PolizasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class PolizasCreator13Test extends TestCase
{
    use WithFakeFiel;

    public function testCreateBalanzaCreator13(): void
    {
        $attributes = [
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ];

        $creator = new PolizasCreator13($attributes);

        $this->assertInstanceOf(PolizasCreator13::class, $creator);
        $this->assertEquals($creator->polizas()->attributes()->get('Mes'), $attributes['Mes']);
        $this->assertEquals($creator->polizas()->attributes()->get('Anio'), $attributes['Anio']);
        $this->assertEquals($creator->polizas()->attributes()->get('TipoSolicitud'), $attributes['TipoSolicitud']);
        $this->assertEquals($creator->polizas()->attributes()->get('NumTramite'), $attributes['NumTramite']);
    }

    public function testWhenPutSelloAddAttributes(): void
    {
        $fiel = $this->buildFiel();

        $creator = new PolizasCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $creator->addSello($fiel);

        $attributes = $creator->polizas()->attributes()->exportArray();

        $this->assertArrayHasKey('RFC', $attributes);
        $this->assertArrayHasKey('noCertificado', $attributes);
        $this->assertArrayHasKey('Certificado', $attributes);
        $this->assertArrayHasKey('Sello', $attributes);
        $this->assertEquals($fiel->rfc(), $attributes['RFC']);
        $this->assertEquals($fiel->certificate()->serialNumber()->bytes(), $attributes['noCertificado']);
        $this->assertEquals($fiel->certificate()->pemAsOneLine(), $attributes['Certificado']);
        $this->assertNotEmpty($attributes['Sello']);
    }

    public function testConvertBalanzaAsXml(): void
    {
        $fiel = $this->buildFiel();

        $creator = new PolizasCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
            'NumTramite' => '123456',
        ]);

        $polizas = $creator->polizas();

        $poliza = $polizas->addPoliza([
            'NumUnIdenPol' => '123456',
            'Fecha' => '2021-03-31',
            'Concepto' => 'Concepto póliza',
        ]);

        $transaccion = $poliza->addTransaccion([
            'NumCta' => '123',
            'DesCta' => 'Descripción cuenta',
            'Concepto' => 'Concepto transacción',
            'Debe' => '100.00',
            'Haber' => '0.00',
        ]);

        $transaccion->addCompNal([
            'UUID_CFDI' => 'adf9d1d2-574d-4781-8874-a9fb1e79930a',
            'RFC' => 'XAXX010101000',
            'MontoTotal' => '100.00',
            'Moneda' => 'MXN',
        ]);

        $creator->addSello($fiel);

        $expectedSourceString = '||1.3|EKU9003173C9|01|2021|AF|123456|123456|2021-03-31|Concepto póliza|123'
            . '|Concepto transacción|100.00|0.00|adf9d1d2-574d-4781-8874-a9fb1e79930a||';
        $this->assertSame($expectedSourceString, $creator->buildCadenaDeOrigen());

        $expectedFile = __DIR__ . '/../_files/polizas-sample.xml';
        $this->assertXmlStringEqualsXmlFile($expectedFile, $creator->asXml());
    }
}
