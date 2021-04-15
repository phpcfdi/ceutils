<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Definitions;

interface Polizas13Definition
{
    public const NAMESPACE = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/PolizasPeriodo';

    public const XSD_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/PolizasPeriodo'
        . '/PolizasPeriodo_1_3.xsd';

    public const XSLT_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_1/PolizasPeriodo'
        . '/PolizasPeriodo_1_1.xslt';

    public const ELEMENT_NAME = 'PLZ:Polizas';
}
