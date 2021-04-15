<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Polizas13\Base;

use PhpCfdi\CeUtils\Definitions\Polizas13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseCertificate;

/**
 * Valida el atributo certificado y que coincida con los valores del documento
 *
 * PLZ13CER01 - El certificado se puede leer
 * PLZ13CER02 - El número del certificado es el mismo que el contenido en el certificado
 * PLZ13CER03 - El Rfc del documento es el mismo que el contenido en el certificado
 * PLZ13CER04 - El sello coincide con los datos del documento y el certificado
 */
class Certificate extends BaseCertificate
{
    public static function create(): self
    {
        return new self('PLZ13CER', Polizas13Definition::XSLT_LOCATION);
    }
}
