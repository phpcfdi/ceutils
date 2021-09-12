<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Tests\Unit\Validate\Common;

use CfdiUtils\Nodes\Node;
use CfdiUtils\Validate\Asserts;
use LogicException;
use PhpCfdi\CeUtils\Tests\TestCase;
use PhpCfdi\CeUtils\Validate\Common\BaseUniquePolizaNumber;

final class BaseNumUnIdenPolTest extends TestCase
{
    private BaseUniquePolizaNumber $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new class('FOO', 'a:foo') extends BaseUniquePolizaNumber {
            public static function create(): self
            {
                throw new LogicException("Static method won't be tested");
            }
        };
    }

    public function testProperties(): void
    {
        // defined in set up
        $this->assertSame('FOOX', $this->validator->getAssertCode('X'));
        $this->assertSame('a:foo', $this->validator->getChildName());
    }

    public function testValidateWithoutNodes(): void
    {
        $root = new Node('a:root', [], [new Node('a:non-foo')]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isNone());
    }

    public function testValidateAllUniqueNumbersAreDifferent(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', ['NumUnIdenPol' => '0001']),
            new Node('a:foo', ['NumUnIdenPol' => '0002']),
            new Node('a:foo', ['NumUnIdenPol' => '0003']),
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        print_r($asserts->errors());
        $this->assertTrue($asserts->get('FOO')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-003')->getStatus()->isOk());
        $this->assertFalse($asserts->exists('FOO-004'));
    }

    public function testValidateSomeRfcAreInvalid(): void
    {
        $root = new Node('a:root', [], [
            new Node('a:foo', ['NumUnIdenPol' => 'REPEATED-1']),
            new Node('a:foo', ['NumUnIdenPol' => 'UNIQUE-1']),
            new Node('a:foo', ['NumUnIdenPol' => 'REPEATED-2']),
            new Node('a:foo', ['NumUnIdenPol' => 'REPEATED-2']),
            new Node('a:foo', ['NumUnIdenPol' => 'UNIQUE-2']),
            new Node('a:foo', ['NumUnIdenPol' => 'REPEATED-1']),
        ]);
        $asserts = new Asserts();
        $this->validator->validate($root, $asserts);
        $this->assertTrue($asserts->get('FOO')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-001')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-002')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-003')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-004')->getStatus()->isError());
        $this->assertTrue($asserts->get('FOO-005')->getStatus()->isOk());
        $this->assertTrue($asserts->get('FOO-006')->getStatus()->isError());
    }
}
