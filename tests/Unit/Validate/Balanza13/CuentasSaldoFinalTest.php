<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Balanza13;

use CfdiUtils\Validate\Asserts;
use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Internal\Amount;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Balanza13\CuentasSaldoFinal;

final class CuentasSaldoFinalTest extends TestCase
{
    public function testAmountAllMatches(): void
    {
        $balanza = (new BalanzaCreator13([]))->balanza();
        $balanza->multiCuenta(
            ['SaldoIni' => '1.01', 'Debe' => '1.02', 'Haber' => '1.03', 'SaldoFin' => '1.00'],
            ['SaldoIni' => '1.06', 'Debe' => '1.22', 'Haber' => '1.13', 'SaldoFin' => '1.15'],
            ['SaldoIni' => '-1.06', 'Debe' => '-1.22', 'Haber' => '-1.13', 'SaldoFin' => '-1.15'],
            ['SaldoIni' => Amount::MAX_VALUE, 'Debe' => '-0.01', 'Haber' => '-0.01', 'SaldoFin' => Amount::MAX_VALUE],
        );
        $validator = CuentasSaldoFinal::create();
        $asserts = new Asserts();
        $validator->validate($balanza, $asserts);
        $this->assertTrue($asserts->exists('BAL13SF01'));

        $this->assertTrue($asserts->get('BAL13SF01')->getStatus()->isOk());
        $this->assertTrue($asserts->get('BAL13SF01-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('BAL13SF01-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('BAL13SF01-003')->getStatus()->isOk());
        $this->assertTrue($asserts->get('BAL13SF01-004')->getStatus()->isOk());
    }

    public function testAmountOneDoesNotMatch(): void
    {
        $balanza = (new BalanzaCreator13([]))->balanza();
        $balanza->multiCuenta(
            ['SaldoIni' => '1.01', 'Debe' => '1.02', 'Haber' => '1.03', 'SaldoFin' => '1.00'],
            ['SaldoIni' => '1.06', 'Debe' => '1.22', 'Haber' => '1.13', 'SaldoFin' => '1.16'],
        );
        $validator = CuentasSaldoFinal::create();
        $asserts = new Asserts();
        $validator->validate($balanza, $asserts);

        $this->assertTrue($asserts->exists('BAL13SF01'));
        $this->assertTrue($asserts->get('BAL13SF01')->getStatus()->isError());
        $this->assertTrue($asserts->get('BAL13SF01-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('BAL13SF01-002')->getStatus()->isError());
    }
}
