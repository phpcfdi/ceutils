<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\AuxiliarFolios13;

use PhpCfdi\CeUtils\AuxiliarFoliosCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class ValidateTest extends TestCase
{
    use WithFakeFiel;

    public function testValidateMinimalCreatedDocument(): void
    {
        $fiel = $this->buildFiel();
        $creator = new AuxiliarFoliosCreator13([
            'RFC' => $fiel->certificate()->rfc(),
            'Mes' => '01',
            'Anio' => '2021',
            'TipoSolicitud' => 'AF',
        ]);
        $creator->addSello($fiel);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
