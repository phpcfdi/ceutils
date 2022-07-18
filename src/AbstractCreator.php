<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\CadenaOrigen\DOMBuilder;
use CfdiUtils\CadenaOrigen\XsltBuilderPropertyTrait;
use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Nodes\XmlNodeUtils;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\XmlResolver\XmlResolver;
use CfdiUtils\XmlResolver\XmlResolverPropertyTrait;
use PhpCfdi\CeUtils\Validate\MultiValidator;
use PhpCfdi\Credentials\Credential;

abstract class AbstractCreator
{
    use XsltBuilderPropertyTrait;
    use XmlResolverPropertyTrait;

    public function __construct(?XmlResolver $xmlResolver = null)
    {
        $this->setXsltBuilder(new DOMBuilder());
        $this->setXmlResolver($xmlResolver ?? new XmlResolver());
    }

    abstract protected function getRootNode(): NodeInterface;

    abstract protected function getXsltLocation(): string;

    abstract protected function createValidator(): MultiValidator;

    protected function getSelloAlgorithm(): int
    {
        return OPENSSL_ALGO_SHA1;
    }

    public function addSello(Credential $credential): self
    {
        $this->getRootNode()->addAttributes([
            'RFC' => $credential->certificate()->rfc(),
            'noCertificado' => $credential->certificate()->serialNumber()->bytes(),
            'Certificado' => $credential->certificate()->pemAsOneLine(),
        ]);

        $cadenaDeOrigen = $this->buildCadenaDeOrigen();

        $this->getRootNode()->addAttributes([
            'Sello' => base64_encode(
                $credential->privateKey()->sign($cadenaDeOrigen, $this->getSelloAlgorithm()),
            ),
        ]);

        return $this;
    }

    public function buildCadenaDeOrigen(): string
    {
        $location = $this->getXmlResolver()->resolve($this->getXsltLocation(), 'XSLT');
        $sourceString = $this->getXsltBuilder()->build($this->asXml(), $location);
        if ('' === trim($sourceString, '|')) {
            throw new \RuntimeException('Unable to create the source string');
        }
        return $sourceString;
    }

    public function asXml(): string
    {
        return XmlNodeUtils::nodeToXmlString($this->getRootNode());
    }

    public function validate(): Asserts
    {
        $validator = $this->createValidator();

        $hydrater = $validator->getHydrater();
        $hydrater->setXmlString($this->asXml());
        $hydrater->setXmlResolver($this->xmlResolver);
        $hydrater->setXsltBuilder($this->xsltBuilder);

        return $validator->validate($this->getRootNode());
    }
}
