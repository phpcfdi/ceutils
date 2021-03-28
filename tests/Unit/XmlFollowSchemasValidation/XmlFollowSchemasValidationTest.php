<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\XmlFollowSchemasValidation;

use InvalidArgumentException;
use PhpCfdi\CeUtils\BalanzaCreator13;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\XmlFollowSchemasValidation\XmlFollowSchemasValidation;
use PhpCfdi\CeUtils\XmlFollowSchemasValidation\XmlFollowSchemasValidationException;
use PhpCfdi\CeUtils\XmlFollowSchemasValidation\XmlFollowSchemasValidationInterface;

class XmlFollowSchemasValidationTest extends TestCase
{
    public function testImplementsXmlFollowSchemasValidationInterface(): void
    {
        $this->assertTrue(
            is_subclass_of(XmlFollowSchemasValidation::class, XmlFollowSchemasValidationInterface::class)
        );
    }

    public function testValidateEmptyXml(): void
    {
        $validator = new XmlFollowSchemasValidation();
        $this->expectException(InvalidArgumentException::class);
        $validator->validate('');
    }

    public function testValidateValidXml(): void
    {
        $validator = new XmlFollowSchemasValidation();
        $validator->validate('<root />');
        $this->assertTrue(true, 'This operation must not throw any exception');
    }

    public function testValidateInvalidKnownBalanza(): void
    {
        $balanzaNamespace = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion';
        $creator = new BalanzaCreator13([]);
        $validator = new XmlFollowSchemasValidation();
        try {
            $validator->validate($creator->asXml(), $creator->getXmlResolver());
        } catch (XmlFollowSchemasValidationException $exception) {
            $this->assertEquals($creator->asXml(), $exception->getXml());
            $this->assertTrue($exception->getSchemas()->exists($balanzaNamespace));
            $this->assertNotEmpty($exception->getErrors());
        }
    }
}
