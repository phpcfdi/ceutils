<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\XmlFollowSchemasValidation;

use RuntimeException;
use XmlSchemaValidator\LibXmlException;
use XmlSchemaValidator\Schemas;

/**
 * @method LibXmlException getPrevious()
 */
final class XmlFollowSchemasValidationException extends RuntimeException
{
    private string $xml;

    private Schemas $schemas;

    public function __construct(string $message, string $xml, Schemas $schemas, LibXmlException $previous)
    {
        parent::__construct($message, 0, $previous);
        $this->xml = $xml;
        $this->schemas = $schemas;
    }

    public function getXml(): string
    {
        return $this->xml;
    }

    public function getSchemas(): Schemas
    {
        return $this->schemas;
    }

    /** @return string[] */
    public function getErrors(): array
    {
        $errors = [];
        for ($ex = $this->getPrevious(); null !== $ex; $ex = $ex->getPrevious()) {
            $errors[] = $ex->getMessage();
        }
        return array_reverse($errors);
    }
}
