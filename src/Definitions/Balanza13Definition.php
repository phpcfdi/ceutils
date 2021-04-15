<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Definitions;

interface Balanza13Definition
{
    public const NAMESPACE = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion';

    public const XSD_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/BalanzaComprobacion'
        . '/BalanzaComprobacion_1_3.xsd';

    public const XSLT_LOCATION = 'https://www.sat.gob.mx/esquemas/ContabilidadE/1_1/BalanzaComprobacion'
        . '/BalanzaComprobacion_1_1.xslt';

    public const ELEMENT_NAME = 'BCE:Balanza';
}
