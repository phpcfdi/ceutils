<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseDifferentRfc;

final class BaseDifferentRfcTest extends TestCase
{
    private BaseDifferentRfc $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new class ('FOO', ...['a:foo', 'a:bar']) extends BaseDifferentRfc {
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
        $root = new Node('a:root', ['RFC' => 'AAA010101AAA']);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isNone());
    }

    public function testValidateAllRfcAreOk(): void
    {
        $root = new Node('a:root', ['RFC' => 'AAA010101AAA'], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', ['RFC' => 'XXX010101XX1'])]), // correct 1
            new Node('a:foo', [], [new Node('a:bar', ['RFC' => 'XXX010101XX2'])]), // correct 2
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertFalse($asserts->exists('FOO-003'));
    }

    public function testValidateSomeRfcAreInvalid(): void
    {
        $root = new Node('a:root', ['RFC' => 'AAA010101AAA'], [
            new Node('a:foo', [], []), // empty
            new Node('a:foo', [], [new Node('a:not-bar')]), // different
            new Node('a:foo', [], [new Node('a:bar', ['RFC' => 'XXX010101XX1'])]), // correct 1
            new Node('a:foo', [], [new Node('a:bar', ['RFC' => ''])]), // correct 2
            new Node('a:foo', [], [new Node('a:bar', [])]), // correct 3
            new Node('a:foo', [], [new Node('a:bar', ['RFC' => 'AAA010101AAA'])]), // incorrect 4
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-003')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-004')->getStatus()->isError());
        $this->assertFalse($asserts->exists('FOO-005'));
    }
}
