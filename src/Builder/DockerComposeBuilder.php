<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Builder;

use Invanilla\DockerComposeGenerator\Configuration\Service;
use Invanilla\DockerComposeGenerator\File\DockerComposeFile;
use Ramsey\Collection\Collection;
use Ramsey\Collection\CollectionInterface;

class DockerComposeBuilder
{
    public function __construct(
        protected string $version = '',
        protected readonly CollectionInterface $services = new Collection(ServiceBuilder::class)
    ) {
    }

    public function version(string $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function build(): DockerComposeFile
    {
        return new DockerComposeFile(
            $this->version,
            new Collection(
                Service::class,
                $this->services->map(fn(ServiceBuilder $builder) => $builder->build())->toArray()
            )
        );
    }

    /**
     * @param callable $configurator
     * @return $this
     */
    public function service(callable $configurator): static
    {
        $this->services->add(
            $configurator(new ServiceBuilder())
        );

        return $this;
    }
}
