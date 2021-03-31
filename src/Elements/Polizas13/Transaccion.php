<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Elements\Polizas13;

use CfdiUtils\Elements\Common\AbstractElement;

class Transaccion extends AbstractElement
{
    public function getElementName(): string
    {
        return 'PLZ:Transaccion';
    }

    public function addCompNal(array $attributes): CompNal
    {
        $comprNal = new CompNal($attributes);
        $this->addChild($comprNal);
        return $comprNal;
    }

    public function multiCompNal(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addCompNal($attributes);
        }
        return $this;
    }

    public function addCompNalOtr(array $attributes): CompNalOtr
    {
        $compNalOtr = new CompNalOtr($attributes);
        $this->addChild($compNalOtr);
        return $compNalOtr;
    }

    public function multiCompNalOtr(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addCompNalOtr($attributes);
        }
        return $this;
    }

    public function addCompExt(array $attributes): CompExt
    {
        $compExt = new CompExt($attributes);
        $this->addChild($compExt);
        return $compExt;
    }

    public function multiCompExt(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addCompExt($attributes);
        }
        return $this;
    }

    public function addCheque(array $attributes): Cheque
    {
        $cheque = new Cheque($attributes);
        $this->addChild($cheque);
        return $cheque;
    }

    public function multiCheque(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addCheque($attributes);
        }
        return $this;
    }

    public function addTransferencia(array $attributes): Transferencia
    {
        $transferencia = new Transferencia($attributes);
        $this->addChild($transferencia);
        return $transferencia;
    }

    public function multiTransferencia(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addTransferencia($attributes);
        }
        return $this;
    }

    public function addOtrMetodoPago(array $attributes): OtrMetodoPago
    {
        $otrMetodoPago = new OtrMetodoPago($attributes);
        $this->addChild($otrMetodoPago);
        return $otrMetodoPago;
    }

    public function multiOtrMetodoPago(array ...$attributesGroup): self
    {
        foreach ($attributesGroup as $attributes) {
            $this->addOtrMetodoPago($attributes);
        }
        return $this;
    }
}
