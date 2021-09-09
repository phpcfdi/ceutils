<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseExchangeRate;

final class BaseExchangeRateTest extends TestCase
{
    private BaseExchangeRate $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new class('FOO_', ...['a:foo', 'a:bar']) extends BaseExchangeRate {
            public static function create(): self
            {
                throw new LogicException('Static method wont be tested');
            }
        };
    }

    public function testProperties(): void
    {
        // defined in set up
        $this->assertSame('FOO_X', $this->validator->getAssertCode('X'));
        $this->assertSame(['a:foo', 'a:bar'], $this->validator->getPath());
    }

    public function testValidateWithoutNodes(): void
    {
        $root = new Node('a:root');
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO_EXR')->getStatus()->isNone());
    }

    public function testValidateExchangeRateIsDefinedWhenRequired(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD', 'TipCamb' => '20.0001'])]), // correct 1
            new Node('a:foo', [], [
                new Node('a:bar', ['Moneda' => 'USD', 'TipCamb' => '20.0002']), // correct 2
                new Node('a:bar', ['Moneda' => 'USD', 'TipCamb' => '20.0003']), // correct 3
            ]),
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO_EXR')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO_EXR-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO_EXR-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO_EXR-003')->getStatus()->isOk());
        $this->assertFalse($asserts->exists('FOO_EXR-004'));
    }

    public function testValidateExchangeRateIsInvalid(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', [])]), // correct 1
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD', 'TipCamb' => '20.0002'])]), // correct 2
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD'])]), // incorrect 3
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD', 'TipCamb' => ''])]), // incorrect 4
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO_EXR')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO_EXR-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO_EXR-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO_EXR-003')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO_EXR-004')->getStatus()->isError());
        $this->assertFalse($asserts->exists('FOO_EXR-005'));
    }
}
