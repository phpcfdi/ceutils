<?php

declare(strict_types=1);

namespace PhpCfdi\CeUtils\Validate;

use CfdiUtils\Nodes\NodeInterface;
use CfdiUtils\Validate\Asserts;
use Generator;
use LogicException;

abstract class MultiValidator
{
    /** @var array<class-string> */
    protected array $validatorClasses = [];

    private Hydrater $hydrater;

    public function __construct()
    {
        $this->hydrater = new Hydrater();
    }

    /**
     * @return array<class-string>
     */
    public function getValidatorClasses(): array
    {
        return $this->validatorClasses;
    }

    public function getHydrater(): Hydrater
    {
        return $this->hydrater;
    }

    public function validate(NodeInterface $root): Asserts
    {
        $asserts = new Asserts();
        foreach ($this->createValidators() as $validator) {
            $validator->validate($root, $asserts);
            if ($asserts->mustStop()) {
                break;
            }
        }
        return $asserts;
    }

    /**
     * @return Generator<ValidatorInterface>
     */
    protected function createValidators(): Generator
    {
        foreach ($this->getValidatorClasses() as $validatorClass) {
            yield $this->createValidator($validatorClass);
        }
    }

    /**
     * Creates an hydrated validator
     *
     * @param class-string $validatorClass
     * @return ValidatorInterface
     */
    protected function createValidator(string $validatorClass): ValidatorInterface
    {
        if (! is_subclass_of($validatorClass, ValidatorInterface::class)) {
            throw new LogicException(
                sprintf('The class %s is not a subclass of %s', $validatorClass, ValidatorInterface::class),
            );
        }
        $validator = call_user_func([$validatorClass, 'create']);
        $this->hydrater->hydrate($validator);
        return $validator;
    }
}
