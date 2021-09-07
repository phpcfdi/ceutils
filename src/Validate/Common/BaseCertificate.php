<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Common;

use CfdiUtils\CadenaOrigen\XsltBuilderPropertyTrait;
use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Contracts\RequireXmlResolverInterface;
use CfdiUtils\Validate\Contracts\RequireXmlStringInterface;
use CfdiUtils\Validate\Contracts\RequireXsltBuilderInterface;
use CfdiUtils\Validate\Status;
use CfdiUtils\Validate\Traits\XmlStringPropertyTrait;
use CfdiUtils\XmlResolver\XmlResolverPropertyTrait;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;
use PhpCfdi\Credentials\Certificate;
use UnexpectedValueException;

abstract class BaseCertificate implements
    ValidatorInterface,
    RequireXmlStringInterface,
    RequireXmlResolverInterface,
    RequireXsltBuilderInterface
{
    use XmlStringPropertyTrait;

    use XmlResolverPropertyTrait;

    use XsltBuilderPropertyTrait;

    private string $assertPrefix;

    private string $xsltLocation;

    public function __construct(string $assertPrefix, string $xsltLocation)
    {
        $this->assertPrefix = $assertPrefix;
        $this->xsltLocation = $xsltLocation;
    }

    public function getAssertCode(string $suffix): string
    {
        return $this->assertPrefix . $suffix;
    }

    public function getXsltLocation(): string
    {
        return $this->xsltLocation;
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $certificateContents = $root['Certificado'];

        $certificateAssert = $asserts->put('01', 'El certificado se puede leer', Status::ok());
        $asserts->put(
            $this->getAssertCode('02'),
            'El número del certificado es el mismo que el contenido en el certificado'
        );
        $asserts->put(
            $this->getAssertCode('03'),
            'El Rfc del documento es el mismo que el contenido en el certificado'
        );
        $asserts->put(
            $this->getAssertCode('04'),
            'El sello coincide con los datos del documento y el certificado'
        );

        try {
            $certificate = new Certificate($certificateContents);
        } catch (UnexpectedValueException $exception) {
            $certificateAssert->setStatus(
                Status::error(),
                $exception->getMessage()
            );
            return;
        }

        $asserts->putStatus(
            $this->getAssertCode('02'),
            Status::when($certificate->serialNumber()->bytes() === $root['noCertificado']),
            sprintf('Esperado: %s. Actual: %s', $certificate->serialNumber()->bytes(), $root['noCertificado'])
        );

        $asserts->putStatus(
            $this->getAssertCode('03'),
            Status::when($certificate->rfc() === $root['RFC']),
            sprintf('Esperado: %s. Actual: %s', $certificate->rfc(), $root['Rfc'])
        );

        $sourceString = $this->buildSourceString();
        $signature = base64_decode($root['Sello'], true);

        $asserts->putStatus(
            $this->getAssertCode('04'),
            Status::when($certificate->publicKey()->verify($sourceString, $signature, OPENSSL_ALGO_SHA1)),
            "Cadena de origen: $sourceString"
        );
    }

    private function buildSourceString(): string
    {
        $location = $this->getXsltLocation();
        if ($this->hasXmlResolver()) {
            $location = $this->getXmlResolver()->resolve($location, 'XSLT');
        }
        return $this->getXsltBuilder()->build($this->getXmlString(), $location);
    }
}
