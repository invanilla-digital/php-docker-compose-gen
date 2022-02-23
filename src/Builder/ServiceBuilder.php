<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Builder;

use Invanilla\DockerComposeGenerator\Configuration\Service;
use JetBrains\PhpStorm\Pure;
use Ramsey\Collection\Collection;
use Ramsey\Collection\CollectionInterface;
use Ramsey\Collection\Map\TypedMap;
use Ramsey\Collection\Map\TypedMapInterface;

class ServiceBuilder
{
    public function __construct(
        private string $name = '',
        private string $image = '',
        private string $command = '',
        private readonly TypedMapInterface $environment = new TypedMap('string', 'string'),
        private readonly CollectionInterface $configs = new Collection('string')
    ) {
    }

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function image(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function command(string $command): static
    {
        $this->command = $command;

        return $this;
    }

    public function env(string $key, string $value): static
    {
        $this->environment->offsetSet($key, $value);

        return $this;
    }

    public function config(string $configName): static
    {
        $this->configs->add($configName);

        return $this;
    }

    #[Pure]
    public function build(): Service
    {
        return new Service(
            $this->name,
            $this->image,
            $this->command,
            $this->environment,
            $this->configs
        );
    }
}
