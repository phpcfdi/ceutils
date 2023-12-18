<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Catalogo13\Base;

use PhpCfdi\CeUtils\Definitions\Catalogo13Definition;
use PhpCfdi\CeUtils\Validate\Common\BaseCertificate;

/**
 * Valida el atributo certificado y que coincida con los valores del documento
 *
 * CAT13CER01 - El certificado se puede leer
 * CAT13CER02 - El número del certificado es el mismo que el contenido en el certificado
 * CAT13CER03 - El Rfc del documento es el mismo que el contenido en el certificado
 * CAT13CER04 - El sello coincide con los datos del documento y el certificado
 */
final class Certificate extends BaseCertificate
{
    public static function create(): self
    {
        return new self('CAT13CER', Catalogo13Definition::XSLT_LOCATION);
    }
}
