<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Balanza13;

use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class ValidateTest extends TestCase
{
    use WithFakeFiel;

    public function testValidateMinimalCreatedDocument(): void
    {
        $fiel = $this->buildFiel();
        $creator = new BalanzaCreator13([
            'RFC' => $fiel->certificate()->rfc(),
            'Mes' => '01',
            'Anio' => '2021',
            'TipoEnvio' => 'N',
        ]);
        $creator->balanza()->addCuenta([
            'NumCta' => '1',
            'SaldoIni' => '0',
            'Debe' => '0',
            'Haber' => '0',
            'SaldoFin' => '0',
        ]);
        $creator->addSello($fiel);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
