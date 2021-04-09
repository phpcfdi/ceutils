<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Definitions;

interface AuxiliarFolios13Definition
{
    public const NAMESPACE = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarFolios';

    public const XSD_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarFolios'
        . '/AuxiliarFolios_1_3.xsd';

    public const XSLT_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_1/AuxiliarFolios'
        . '/AuxiliarFolios_1_1.xslt';

    public const ELEMENT_NAME = 'RepAux:RepAuxFol';
}
