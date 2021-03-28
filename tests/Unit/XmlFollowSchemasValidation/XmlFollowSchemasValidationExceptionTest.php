<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\XmlFollowSchemasValidation;

use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\XmlFollowSchemasValidation\XmlFollowSchemasValidationException;
use XmlSchemaValidator\LibXmlException;
use XmlSchemaValidator\Schemas;

final class XmlFollowSchemasValidationExceptionTest extends TestCase
{
    public function testProperties(): void
    {
        $message = 'message';
        $xml = 'xml';
        $schemas = new Schemas();
        $previous = new LibXmlException();
        $exception = new XmlFollowSchemasValidationException($message, $xml, $schemas, $previous);

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame($xml, $exception->getXml());
        $this->assertSame($schemas, $exception->getSchemas());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testGetErrors(): void
    {
        // Current LibXmlException has error message in reverse order
        $first = new LibXmlException('error baz');
        $second = new LibXmlException('error bar', 0, $first);
        $last = new LibXmlException('error foo', 0, $second);
        $exception = new XmlFollowSchemasValidationException('', '', new Schemas(), $last);

        $errors = [
            $first->getMessage(),
            $second->getMessage(),
            $last->getMessage(),
        ];

        $this->assertSame($errors, $exception->getErrors());
    }
}
