<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Polizas13;

use PhpCfdi\CeUtils\PolizasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeCsd;

final class ValidateTest extends TestCase
{
    use WithFakeCsd;

    public function testValidateMinimalCreatedDocument(): void
    {
        $credential = $this->buildCredential();
        $creator = new PolizasCreator13([
            'RFC' => $credential->certificate()->rfc(),
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
        $creator->addSello($credential);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
