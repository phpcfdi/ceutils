<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13\Base;

use PhpCfdi\CeUtils\Definitions\Balanza13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseCertificate;

/**
 * Valida el atributo certificado y que coincida con los valores del documento
 *
 * BAL13CER01 - El certificado se puede leer
 * BAL13CER02 - El número del certificado es el mismo que el contenido en el certificado
 * BAL13CER03 - El Rfc del documento es el mismo que el contenido en el certificado
 * BAL13CER04 - El sello coincide con los datos del documento y el certificado
 */
final class Certificate extends BaseCertificate
{
    public static function create(): self
    {
        return new self('BAL13CER', Balanza13Definition::XSLT_LOCATION);
    }
}
