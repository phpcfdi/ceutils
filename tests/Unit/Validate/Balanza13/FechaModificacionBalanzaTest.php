<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Balanza13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Balanza13\FechaModificacionBalanza;

final class FechaModificacionBalanzaTest extends TestCase
{
    /** @return array<string, array<string|null>> */
    public function providerTipoEnvioNormalWithFechaModBal(): array
    {
        return [
            'empty' => [null],
            'date' => ['2021-01-13'],
        ];
    }

    /** @dataProvider providerTipoEnvioNormalWithFechaModBal */
    public function testTipoEnvioNormalWithFechaModBal(?string $fechaModBal): void
    {
        $creator = new BalanzaCreator13([
            'TipoEnvio' => 'N',
            'FechaModBal' => $fechaModBal,
        ]);

        $validator = FechaModificacionBalanza::create();
        $asserts = new Asserts();
        $validator->validate($creator->balanza(), $asserts);

        $this->assertTrue($asserts->exists('BAL13FMB01'));
        $this->assertTrue($asserts->get('BAL13FMB01')->getStatus()->isNone());
    }

    public function testTipoEnvioComplementoWithFechaModBal(): void
    {
        $creator = new BalanzaCreator13([
            'TipoEnvio' => 'C',
            'FechaModBal' => '2021-01-13',
        ]);

        $validator = FechaModificacionBalanza::create();
        $asserts = new Asserts();
        $validator->validate($creator->balanza(), $asserts);

        $this->assertTrue($asserts->exists('BAL13FMB01'));
        $this->assertTrue($asserts->get('BAL13FMB01')->getStatus()->isOk());
    }

    public function testTipoEnvioComplementoWithoutFechaModBal(): void
    {
        $creator = new BalanzaCreator13([
            'TipoEnvio' => 'C',
        ]);

        $validator = FechaModificacionBalanza::create();
        $asserts = new Asserts();
        $validator->validate($creator->balanza(), $asserts);

        $this->assertTrue($asserts->exists('BAL13FMB01'));
        $this->assertTrue($asserts->get('BAL13FMB01')->getStatus()->isError());
    }
}
