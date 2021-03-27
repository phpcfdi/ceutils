<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Catalogo13;

use CfdiUtils\Elements\Common\AbstractElement;

class Cuenta extends AbstractElement
{
    public function getElementName(): string
    {
        return 'catalogocuentas:Ctas';
    }
}
