<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Definitions;

interface AuxiliarCuentas13Definition
{
    public const NAMESPACE = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarCtas';

    public const XSD_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/AuxiliarCtas/AuxiliarCtas_1_3.xsd';

    public const XSLT_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_1/AuxiliarCtas/AuxiliarCtas_1_1.xslt';

    public const ELEMENT_NAME = 'AuxiliarCtas:AuxiliarCtas';
}
