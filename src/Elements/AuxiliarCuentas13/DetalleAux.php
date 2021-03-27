<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarCuentas13;

use CfdiUtils\Elements\Common\AbstractElement;

class DetalleAux extends AbstractElement
{
    public function getElementName(): string
    {
        return 'AuxiliarCtas:DetalleAux';
    }
}
