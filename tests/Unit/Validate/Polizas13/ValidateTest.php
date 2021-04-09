<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\PolizasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class ValidateTest extends TestCase
{
    use WithFakeFiel;

    public function testValidateMinimalCreatedDocument(): void
    {
        $fiel = $this->buildFiel();
        $creator = new PolizasCreator13([
            'RFC' => $fiel->certificate()->rfc(),
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'DE',
        ]);
        $poliza = $creator->polizas()->addPoliza([
            'NumUnIdenPol' => '1',
            'Fecha' => '2021-01-13',
            'Concepto' => 'concepto',
        ]);
        $poliza->addTransaccion([
            'NumCta' => 'cta',
            'DesCta' => 'desc',
            'Concepto' => 'concepto',
            'Debe' => '0',
            'Haber' => '0',
        ]);
        $creator->addSello($fiel);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
