<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Definitions\AuxiliarFolios13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseCertificate;

/**
 * Valida el atributo certificado y que coincida con los valores del documento
 *
 * AUXFOL13CER01 - El certificado se puede leer
 * AUXFOL13CER02 - El número del certificado es el mismo que el contenido en el certificado
 * AUXFOL13CER03 - El Rfc del documento es el mismo que el contenido en el certificado
 * AUXFOL13CER04 - El sello coincide con los datos del documento y el certificado
 */
class Certificate extends BaseCertificate
{
    public static function create(): self
    {
        return new self('AUXFOL13CER', AuxiliarFolios13Definition::XSLT_LOCATION);
    }
}
