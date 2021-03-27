<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Nodes\NodeInterface;
use PhpCfdi\CeUtils\Elements\AuxiliarFolios13\RepAuxFol;

class AuxiliarFoliosCreator13 extends AbstractCreator
{
    public const REP_AUX_FOL_XSLT = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_1/'
    . 'AuxiliarFolios/AuxiliarFolios_1_1.xslt';

    private RepAuxFol $repAuxFol;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->repAuxFol = new RepAuxFol($attributes);
    }

    public function repAuxFol(): RepAuxFol
    {
        return $this->repAuxFol;
    }

    protected function getRootNode(): NodeInterface
    {
        return $this->repAuxFol();
    }

    protected function getXsltLocation(): string
    {
        return self::REP_AUX_FOL_XSLT;
    }
}
