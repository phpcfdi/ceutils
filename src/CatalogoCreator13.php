<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Elements\Catalogo13\Catalogo;

class CatalogoCreator13 extends AbstractCreator
{
    public const CATALOGO_XSLT = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_1/'
    . 'CatalogoCuentas/CatalogoCuentas_1_1.xslt';

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
        return self::CATALOGO_XSLT;
    }
}
