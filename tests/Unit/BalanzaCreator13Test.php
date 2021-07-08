<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit;

use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class BalanzaCreator13Test extends TestCase
{
    use WithFakeFiel;

    public function testCreateBalanzaCreator13(): void
    {
        $attributes = [
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ];

        $creator = new BalanzaCreator13($attributes);

        $this->assertInstanceOf(BalanzaCreator13::class, $creator);
        $this->assertEquals($creator->balanza()->attributes()->get('Mes'), $attributes['Mes']);
        $this->assertEquals($creator->balanza()->attributes()->get('Anio'), $attributes['Anio']);
        $this->assertEquals($creator->balanza()->attributes()->get('TipoEnvio'), $attributes['TipoEnvio']);
        $this->assertEquals($creator->balanza()->attributes()->get('FechaModBal'), $attributes['FechaModBal']);
    }

    public function testWhenPutSelloAddAttributes(): void
    {
        $fiel = $this->buildFiel();

        $creator = new BalanzaCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ]);

        $creator->addSello($fiel);

        $attributes = $creator->balanza()->attributes()->exportArray();

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

        $creator = new BalanzaCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ]);

        $creator->addSello($fiel);

        $expectedSourceString = '||1.3|EKU9003173C9|01|2021|N|2015-01-01||';
        $this->assertSame($expectedSourceString, $creator->buildCadenaDeOrigen());

        $expectedFile = __DIR__ . '/../_files/balanza-sample-without-ctas.xml';
        $this->assertXmlStringEqualsXmlFile($expectedFile, $creator->asXml());
    }
}
