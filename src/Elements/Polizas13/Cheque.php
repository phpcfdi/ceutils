<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Polizas13;

use CfdiUtils\Elements\Common\AbstractElement;

class Cheque extends AbstractElement
{
    public function getElementName(): string
    {
        return 'PLZ:Cheque';
    }
}
