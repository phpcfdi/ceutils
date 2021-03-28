<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\XmlFollowSchemasValidation;

use PhpCfdi\CeUtils\AbstractCreator;
use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;

/**
 * @internal the AbstractCreator::Validate method is extracted to XmlFollowSchemasValidation
 * @see AbstractCreator::validate()
 * @see XmlFollowSchemasValidation
 */
final class AbstractCreatorValidateMethodTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (! is_subclass_of(BalanzaCreator13::class, AbstractCreator::class)) {
            $this->fail(sprintf('%s must be instance of %s', BalanzaCreator13::class, AbstractCreator::class));
        }
    }

    public function testFollowXmlPass(): void
    {
        $creator = new BalanzaCreator13([
            'RFC' => 'AAAA010101AAA',
            'Mes' => '01',
            'Anio' => '2020',
            'TipoEnvio' => 'N',
        ]);
        $creator->balanza()->addCuenta([
            'NumCta' => '1',
            'SaldoIni' => '0',
            'Debe' => '0',
            'Haber' => '0',
            'SaldoFin' => '0',
        ]);
        $errors = $creator->validate();
        $this->assertEmpty($errors, 'It was not expected any errors on validation');
    }

    public function testFollowXmlDetectIssues(): void
    {
        $creator = new BalanzaCreator13([]);

        $errors = $creator->validate();

        $this->assertMatchesRegularExpression(
            '/RFC.*required/i',
            current($errors) ?? '',
            "The first error didn't match with RFC is required"
        );
        $this->assertMatchesRegularExpression(
            '/missing child element.*Ctas/i',
            end($errors) ?? '',
            "The last error didn't match with missing element Ctas"
        );
    }
}
