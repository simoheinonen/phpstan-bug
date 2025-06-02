<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\TypeInfo\TypeContext\TypeContextFactory;

#[AsCommand(name: 'foo')]
class FooCommand extends Command
{
    public function __construct(
        #[Autowire(service: 'type_info.type_context_factory')]
        private TypeContextFactory $typeContextFactory,
    )
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->typeContextFactory->createFromClassName(BarClass::class, BarClass::class);

        return Command::SUCCESS;
    }
}

/**
 * @phpstan-type FooType array{
 *     fooKey: float
 * }
 */
class FooClass
{
}

/**
 * @phpstan-import-type FooType from FooClass
 * @phpstan-type BarType array{
 *      barKey: FooType
 *  }
 */
class BarClass
{
}
