<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils;

use CfdiUtils\Elements\Common\AbstractElement;
use PhpCfdi\CeUtils\Definitions\AuxiliarCuentas13Definition;
use PhpCfdi\CeUtils\Elements\AuxiliarCuentas13\AuxiliarCtas;

class AuxiliarCuentasCreator13 extends AbstractCreator
{
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
        return AuxiliarCuentas13Definition::XSLT_LOCATION;
    }
}
