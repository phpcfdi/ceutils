<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\XmlFollowSchemasValidation;

use CfdiUtils\XmlResolver\XmlResolver;
use XmlResourceRetriever\XsdRetriever;
use XmlSchemaValidator\LibXmlException;
use XmlSchemaValidator\Schema;
use XmlSchemaValidator\Schemas;
use XmlSchemaValidator\SchemaValidator;

final class XmlFollowSchemasValidation implements XmlFollowSchemasValidationInterface
{
    public function validate(string $content, ?XmlResolver $resolver = null): void
    {
        $schemaValidator = new SchemaValidator($content);
        $schemas = $schemaValidator->buildSchemas();
        if (null !== $resolver) {
            $schemas = $this->changeSchemasUsingResolver($resolver, $schemas);
        }
        try {
            $schemaValidator->validateWithSchemas($schemas);
        } catch (LibXmlException $exception) {
            $message = 'The XML does not follow schemas';
            throw new XmlFollowSchemasValidationException($message, $content, $schemas, $exception);
        }
    }

    public function changeSchemasUsingResolver(XmlResolver $resolver, Schemas $schemas): Schemas
    {
        if (! $resolver->hasLocalPath()) {
            return $schemas;
        }

        return $this->changeSchemasUsingRetriever($resolver->newXsdRetriever(), $schemas);
    }

    public function changeSchemasUsingRetriever(XsdRetriever $retriever, Schemas $schemas): Schemas
    {
        foreach ($schemas as $schema) {
            $replacement = $this->changeSchemaUsingRetriever($retriever, $schema);
            $schemas->insert($replacement);
        }

        return $schemas;
    }

    public function changeSchemaUsingRetriever(XsdRetriever $retriever, Schema $schema): Schema
    {
        $location = $schema->getLocation();
        $localPath = $retriever->buildPath($location);
        if (! file_exists($localPath)) {
            $retriever->retrieve($location);
        }

        return new Schema($schema->getNamespace(), $localPath);
    }
}
