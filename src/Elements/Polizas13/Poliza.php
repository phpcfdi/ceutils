<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Polizas13;

use CfdiUtils\Elements\Common\AbstractElement;

class Poliza extends AbstractElement
{
    public function getElementName(): string
    {
        return 'PLZ:Poliza';
    }

    public function addTransaccion(array $attributes): Transaccion
    {
        $transaccion = new Transaccion($attributes);
        $this->addChild($transaccion);
        return $transaccion;
    }

    public function multiTransaccion(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addTransaccion($attributes);
        }
        return $this;
    }
}
