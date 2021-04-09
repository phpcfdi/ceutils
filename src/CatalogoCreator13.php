<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Definitions\Catalogo13Definition;
use PhpCfdi\CeUtils\Elements\Catalogo13\Catalogo;

class CatalogoCreator13 extends AbstractCreator
{
    private Catalogo $catalogo;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->catalogo = new Catalogo($attributes);
    }

    public function catalogo(): Catalogo
    {
        return $this->catalogo;
    }

    protected function getRootNode(): NodeInterface
    {
        return $this->catalogo();
    }

    protected function getXsltLocation(): string
    {
        return Catalogo13Definition::XSLT_LOCATION;
    }
}
