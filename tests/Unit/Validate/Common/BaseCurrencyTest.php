<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseCurrency;

final class BaseCurrencyTest extends TestCase
{
    private BaseCurrency $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new class('FOO', ...['a:foo', 'a:bar']) extends BaseCurrency {
            public static function create(): void
            {
                throw new LogicException("Static method won't be tested");
            }
        };
    }

    public function testProperties(): void
    {
        // defined in set up
        $this->assertSame('FOOX', $this->validator->getAssertCode('X'));
        $this->assertSame(['a:foo', 'a:bar'], $this->validator->getPath());
    }

    public function testValidateWithoutNodes(): void
    {
        $root = new Node('a:root');
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isNone());
    }

    public function testValidateCurrencyIsNotMxn(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD'])]), // correct 1
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD'])]), // correct 2
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertFalse($asserts->exists('FOO-003'));
    }

    public function testValidateCurrencyIsInvalid(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', [])]), // correct 1
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'USD'])]), // correct 2
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => ''])]), // incorrect 3
            new Node('a:foo', [], [new Node('a:bar', ['Moneda' => 'MXN'])]), // incorrect 4
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-003')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-004')->getStatus()->isError());
        $this->assertFalse($asserts->exists('FOO-005'));
    }
}
