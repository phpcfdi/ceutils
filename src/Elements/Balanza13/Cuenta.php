<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Balanza13;

use CfdiUtils\Elements\Common\AbstractElement;

class Cuenta extends AbstractElement
{
    public function getElementName(): string
    {
        return 'BCE:Ctas';
    }
}
