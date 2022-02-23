<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Configuration;

use Ramsey\Collection\CollectionInterface;
use Ramsey\Collection\Map\TypedMapInterface;

class Service
{
    public function __construct(
        protected readonly string $name,
        protected readonly string $image,
        protected readonly string $command,
        protected readonly TypedMapInterface $environment,
        protected readonly CollectionInterface $configs
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return TypedMapInterface
     */
    public function getEnvironment(): TypedMapInterface
    {
        return $this->environment;
    }

    /**
     * @return CollectionInterface
     */
    public function getConfigs(): CollectionInterface
    {
        return $this->configs;
    }
}
