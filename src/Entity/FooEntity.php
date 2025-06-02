<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @phpstan-import-type Foo from FooInterface
 * @phpstan-type Bar array{
 *      internal_price_components: Foo
 *  }
 */
#[ApiResource]
class FooEntity
{
    /**
     * @var Bar
     */
    #[ORM\Column(name: 'data', type: Types::JSON, nullable: false)]
    private array $data = [];
}
