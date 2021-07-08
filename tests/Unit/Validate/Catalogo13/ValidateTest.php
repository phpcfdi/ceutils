<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Catalogo13;

use PhpCfdi\CeUtils\CatalogoCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Tests\Traits\WithFakeCsd;

final class ValidateTest extends TestCase
{
    use WithFakeCsd;

    public function testValidateMinimalCreatedDocument(): void
    {
        $credential = $this->buildCredential();
        $creator = new CatalogoCreator13([
            'RFC' => $credential->certificate()->rfc(),
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

        $creator->addSello($credential);
        $asserts = $creator->validate();
        $this->assertEmpty($asserts->nones());
        $this->assertFalse($asserts->hasErrors());
        $this->assertFalse($asserts->hasWarnings());
    }
}
