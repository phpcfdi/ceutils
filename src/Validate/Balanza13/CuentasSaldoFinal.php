<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate\Balanza13;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use CfdiUtils\Validate\Status;
use PhpCfdi\CeUtils\Internal\Amount;
use PhpCfdi\CeUtils\Validate\ValidatorInterface;

/**
 * Valida la relación entre el saldo inicial, debe, haber y saldo final en una cuenta
 *
 * BAL13SF01 - Para cada cuenta, el saldo final debe ser el saldo inicial más el debe menos el deber
 * BAL13SF01-nnn - El saldo final debe ser el saldo inicial más el debe menos el deber
 */
final class CuentasSaldoFinal implements ValidatorInterface
{
    public static function create(): self
    {
        return new self();
    }

    public function validate(NodeInterface $root, Asserts $asserts): void
    {
        $assert = $asserts->put(
            'BAL13SF01',
            'Para cada cuenta, el saldo final debe ser el saldo inicial más el debe menos el deber'
        );
        $nodes = $root->searchNodes('BCE:Ctas');
        $failedIndexes = [];
        foreach ($nodes as $index => $node) {
            $index = $index + 1; // do not use zero index
            if (! $this->validateNodeCtas($index, $node, $asserts)) {
                $failedIndexes[] = $index;
            }
        }
        $explanation = sprintf(
            'Número de nodos: %d, Nodos con errores: %s.',
            $nodes->count(),
            implode(', ', $failedIndexes) ?: '(ninguno)'
        );
        $assert->setStatus(Status::when([] === $failedIndexes), $explanation);
    }

    public function validateNodeCtas(int $index, NodeInterface $node, Asserts $asserts): bool
    {
        $expected = Amount::create($node['SaldoIni'])
                ->add(Amount::create($node['Debe']))
                ->sub(Amount::create($node['Haber']));

        $equals = $expected->equalsTo(Amount::create($node['SaldoFin']));

        $asserts->put(
            sprintf('BAL13SF01-%03d', $index),
            'El saldo final debe ser el saldo inicial más el debe menos el deber',
            Status::when($equals),
            sprintf(
                'Saldo inicial: %s, Debe: %s, Haber: %s, Saldo final: %s, Esperado: %s',
                $node['SaldoIni'],
                $node['Debe'],
                $node['Haber'],
                $node['SaldoFin'],
                (string) $equals,
            )
        );
        return $equals;
    }
}
