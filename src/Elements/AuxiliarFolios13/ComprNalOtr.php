<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarFolios13;

use CfdiUtils\Elements\Common\AbstractElement;

class ComprNalOtr extends AbstractElement
{
    public function getElementName(): string
    {
        return 'RepAux:ComprNalOtr';
    }
}
