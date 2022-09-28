<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Assert;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Contracts\RequireXmlResolverInterface;
use CfdiUtils\Validate\Contracts\RequireXmlStringInterface;
use CfdiUtils\Validate\Status;
use CfdiUtils\Validate\Traits\XmlStringPropertyTrait;
use CfdiUtils\XmlResolver\XmlResolver;
use CfdiUtils\XmlResolver\XmlResolverPropertyTrait;
use Eclipxe\XmlSchemaValidator\Exceptions\ValidationFailException;
use Eclipxe\XmlSchemaValidator\Schema;
use Eclipxe\XmlSchemaValidator\Schemas;
use Eclipxe\XmlSchemaValidator\SchemaValidator;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;
use XmlResourceRetriever\XsdRetriever;

abstract class BaseDocumentFollowSchemas implements
    ValidatorInterface,
    RequireXmlStringInterface,
    RequireXmlResolverInterface
{
    use XmlStringPropertyTrait;
    use XmlResolverPropertyTrait;

    private string $assertPrefix;

    private string $namespace;

    private string $xsdLocation;

    public function __construct(string $assertPrefix, string $namespace, string $xsdLocation)
    {
        $this->assertPrefix = $assertPrefix;
        $this->namespace = $namespace;
        $this->xsdLocation = $xsdLocation;
    }

    public function getAssertName(string $suffix): string
    {
        return $this->assertPrefix . $suffix;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getXsdLocation(): string
    {
        return $this->xsdLocation;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $this->validateAsserts($asserts);
        if ($asserts->hasErrors()) {
            $asserts->mustStop(true);
        }
    }

    private function validateAsserts(Asserts $asserts): void
    {
        $locationAssert = $asserts->put(
            $this->getAssertName('01'),
            'El documento usa la ruta de la definición de esquema XML definido',
        );
        $xsdAssert = $asserts->put(
            $this->getAssertName('02'),
            'El documento cumple con la definición del esquema XML',
        );

        $content = $this->getXmlString();
        $schemaValidator = SchemaValidator::createFromString($content);
        $schemas = $schemaValidator->buildSchemas();

        // validate location
        if (! $this->validateLocation($schemas, $locationAssert)) {
            return;
        }

        // validate against XSD
        $xsdErrors = $this->validateXsdSchemas($schemaValidator, $schemas);
        $xsdAssert->setStatus(
            Status::when([] === $xsdErrors),
            implode(PHP_EOL, $xsdErrors),
        );
    }

    public function validateLocation(Schemas $schemas, Assert $locationAssert): bool
    {
        $location = '';
        if ($schemas->exists($this->getNamespace())) {
            $location = $schemas->item($this->getNamespace())->getLocation();
        }
        $locationMatches = $this->getXsdLocation() === $location;
        $locationAssert->setStatus(
            Status::when($locationMatches),
            sprintf('Esperado: %s. Actual: %s.', $this->getXsdLocation(), $location),
        );
        return $locationMatches;
    }

    /**
     * @param SchemaValidator $schemaValidator
     * @param Schemas $schemas
     * @return string[] XSD detected errors
     */
    public function validateXsdSchemas(SchemaValidator $schemaValidator, Schemas $schemas): array
    {
        $resolver = $this->xmlResolver;
        if (null !== $resolver) {
            $schemas = $this->changeSchemasUsingResolver($resolver, $schemas);
        }
        try {
            $schemaValidator->validateWithSchemas($schemas);
            return [];
        } catch (ValidationFailException $exception) {
            return $this->validationFailExceptionToArray($exception);
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

    private function validationFailExceptionToArray(ValidationFailException $exception): array
    {
        $errors = [];
        for ($ex = $exception; null !== $ex; $ex = $ex->getPrevious()) {
            $errors[] = $ex->getMessage();
        }
        return array_reverse($errors);
    }
}
