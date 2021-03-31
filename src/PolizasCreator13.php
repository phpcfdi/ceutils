<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Elements\Polizas13\Polizas;

class PolizasCreator13 extends AbstractCreator
{
    public const POLIZAS_XSLT = 'http://www.sat.gob.mx/esquemas/ContabilidadE/'
    .'1_1/PolizasPeriodo/PolizasPeriodo_1_1.xslt';

    private Polizas $polizas;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->polizas = new Polizas($attributes);
    }

    public function polizas(): Polizas
    {
        return $this->polizas;
    }

    protected function getRootNode(): NodeInterface
    {
        return $this->polizas();
    }

    protected function getXsltLocation(): string
    {
        return self::POLIZAS_XSLT;
    }
}
