<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarCuentas13;

use PhpCfdi\CeUtils\AuxiliarCuentasCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class ValidateTest extends TestCase
{
    use WithFakeFiel;

    public function testValidateMinimalCreatedDocument(): void
    {
        $fiel = $this->buildFiel();
        $creator = new AuxiliarCuentasCreator13([
            'RFC' => $fiel->certificate()->rfc(),
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
        ]);
        $cuenta = $creator->auxiliarCuentas()->addCuenta([
            'NumCta' => '1',
            'DesCta' => 'Descripción',
            'SaldoIni' => '0',
            'SaldoFin' => '0',
        ]);
        $cuenta->addDetalleAux([
            'Fecha' => '2021-01-13',
            'NumUnIdenPol' => '1',
            'Concepto' => 'Concepto',
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
