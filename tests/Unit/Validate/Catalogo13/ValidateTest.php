<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Catalogo13;

use PhpCfdi\CeUtils\CatalogoCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeFiel;

final class ValidateTest extends TestCase
{
    use WithFakeFiel;

    public function testValidateMinimalCreatedDocument(): void
    {
        $fiel = $this->buildFiel();
        $creator = new CatalogoCreator13([
            'RFC' => $fiel->certificate()->rfc(),
            'Mes' => '01',
            'Anio' => '2021',
        ]);
        $creator->catalogo()->addCuenta([
            'CodAgrup' => '602',
            'NumCta' => '602.01.01',
            'Desc' => 'Account description',
            'SubCtaDe' => '602.01',
            'Nivel' => '3',
            'Natur' => 'A',
        ]);

        $creator->addSello($fiel);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
