<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\AuxiliarFolios13\Base;

use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

/**
 * Valida el atributo RFC en RepAuxFol/DetAuxFol/ComprNalOtr
 *
 * AUXFOL13COMOTRRFC - Los RFC de la información detallada deben ser distintos al RFC del emisor
 * AUXFOL13COMOTRRFC-NNN - El RFC de referencia debe ser distinto al registro del que envía los datos
 */
final class DifferentRfcDetAuxFolComprNalOtr extends BaseDifferentRfc
{
    public static function create(): self
    {
        return new self('AUXFOL13COMOTR', 'RepAux:DetAuxFol', 'RepAux:ComprNalOtr');
    }
}
