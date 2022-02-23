<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\File;

use Invanilla\DockerComposeGenerator\Configuration\Service;
use Ramsey\Collection\Collection;
use Ramsey\Collection\CollectionInterface;

class DockerComposeFile
{
    public function __construct(
        protected readonly string $version,
        protected readonly CollectionInterface $services = new Collection(Service::class),
        protected readonly CollectionInterface $volumes = new Collection(''),
        protected readonly CollectionInterface $configs = new Collection(''),
        protected readonly CollectionInterface $secrets = new Collection(''),
        protected readonly CollectionInterface $networks = new Collection('')
    ) {
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return CollectionInterface&iterable<Service>
     */
    public function getServices():CollectionInterface
    {
        return $this->services;
    }
}
