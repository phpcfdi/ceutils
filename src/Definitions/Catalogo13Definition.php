<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Definitions;

interface Catalogo13Definition
{
    public const NAMESPACE = 'http://www.sat.gob.mx/esquemas/ContabilidadE/1_3/CatalogoCuentas';

    public const XSD_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE'
        . '/1_3/CatalogoCuentas/CatalogoCuentas_1_3.xsd';

    public const XSLT_LOCATION = 'http://www.sat.gob.mx/esquemas/ContabilidadE'
        . '/1_3/CatalogoCuentas/CatalogoCuentas_1_2.xslt';

    public const ELEMENT_NAME = 'catalogocuentas:Catalogo';
}
