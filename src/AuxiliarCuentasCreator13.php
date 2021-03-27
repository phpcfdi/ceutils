<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\AuxiliarCtas;

class AuxiliarCuentasCreator13 extends AbstractCreator
{
    public const AUX_CTAS_XSLT = 'http://www.sat.gob.mx/esquemas/ContabilidadE/'
    . '1_1/AuxiliarCtas/AuxiliarCtas_1_1.xslt';

    private AuxiliarCtas $auxiliarCuentas;

    /**
     * @param  array<string, string>  $attributes
     */
    public function __construct(array $attributes)
    {
        parent::__construct();
        $this->auxiliarCuentas = new AuxiliarCtas($attributes);
    }

    public function auxiliarCuentas(): AuxiliarCtas
    {
        return $this->auxiliarCuentas;
    }

    protected function getRootNode(): AbstractElement
    {
        return $this->auxiliarCuentas();
    }

    protected function getXsltLocation(): string
    {
        return self::AUX_CTAS_XSLT;
    }
}
