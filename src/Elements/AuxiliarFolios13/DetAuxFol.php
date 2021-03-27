<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\AuxiliarFolios13;

use CfdiUtils\Elements\Common\AbstractElement;

class DetAuxFol extends AbstractElement
{
    public function getElementName(): string
    {
        return 'RepAux:DetAuxFol';
    }

    public function getChildrenOrder(): array
    {
        return [
            'RepAux:ComprNal',
            'RepAux:ComprNalOtr',
            'RepAux:ComprExt',
        ];
    }

    public function addComprNal(array $attributes = []): ComprNal
    {
        $element = new ComprNal($attributes);
        $this->addChild($element);
        return $element;
    }

    public function addComprNalOtr(array $attributes = []): ComprNalOtr
    {
        $element = new ComprNalOtr($attributes);
        $this->addChild($element);
        return $element;
    }

    public function addComprExt(array $attributes = []): ComprExt
    {
        $element = new ComprExt($attributes);
        $this->addChild($element);
        return $element;
    }

    public function multiComprNal(array ...$elementAttributes): self
    {
        foreach ($elementAttributes as $attributes) {
            $this->addComprNal($attributes);
        }
        return $this;
    }

    public function multiComprNalOtr(array ...$elementAttributes): self
    {
        foreach ($elementAttributes as $attributes) {
            $this->addComprNalOtr($attributes);
        }
        return $this;
    }

    public function multiComprExt(array ...$elementAttributes): self
    {
        foreach ($elementAttributes as $attributes) {
            $this->addComprExt($attributes);
        }
        return $this;
    }
}
