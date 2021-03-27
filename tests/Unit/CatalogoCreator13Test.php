<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit;

use PhpCfdi\CeUtils\CatalogoCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class CatalogoCreator13Test extends TestCase
{
    use WithFakeFiel;

    public function testCreateCatalogoCreator13(): void
    {
        $attributes = [
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ];

        $creator = new CatalogoCreator13($attributes);

        $this->assertInstanceOf(CatalogoCreator13::class, $creator);
        $this->assertEquals($creator->catalogo()->attributes()->get('Mes'), $attributes['Mes']);
        $this->assertEquals($creator->catalogo()->attributes()->get('Anio'), $attributes['Anio']);
        $this->assertEquals($creator->catalogo()->attributes()->get('TipoEnvio'), $attributes['TipoEnvio']);
        $this->assertEquals($creator->catalogo()->attributes()->get('FechaModBal'), $attributes['FechaModBal']);
    }

    public function testWhenPutSelloAddAttributes(): void
    {
        $fiel = $this->buildFiel();

        $creator = new CatalogoCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ]);

        $creator->addSello($fiel);

        $attributes = $creator->catalogo()->attributes()->exportArray();

        $this->assertArrayHasKey('RFC', $attributes);
        $this->assertArrayHasKey('noCertificado', $attributes);
        $this->assertArrayHasKey('certificado', $attributes);
        $this->assertArrayHasKey('sello', $attributes);
        $this->assertEquals($fiel->rfc(), $attributes['RFC']);
        $this->assertEquals($fiel->certificate()->serialNumber()->decimal(), $attributes['noCertificado']);
        $this->assertEquals($fiel->certificate()->pemAsOneLine(), $attributes['certificado']);
        $this->assertNotEmpty($attributes['sello']);
    }

    public function testConvertCatalogoAsXml(): void
    {
        $fiel = $this->buildFiel();

        $creator = new CatalogoCreator13([
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
            'FechaModBal' => '2015-01-01',
        ]);

        $creator->addSello($fiel);

        $expectedFile = __DIR__ . '/../_files/catalogo-sample-without-ctas.xml';
        $this->assertXmlStringEqualsXmlFile($expectedFile, $creator->asXml());
    }
}
