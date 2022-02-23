<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Tests\Unit;

use Invanilla\DockerComposeGenerator\Serializer\DockerComposeFileSerializerInterface;
use Invanilla\DockerComposeGenerator\Serializer\DockerComposeFileYamlSerializer;
use JetBrains\PhpStorm\Pure;

class DockerComposeFileYamlSerializerTest extends AbstractDockerComposeFileSerializerTestCase
{
    #[Pure]
    protected function getImplementation(): DockerComposeFileSerializerInterface
    {
        return new DockerComposeFileYamlSerializer();
    }
}
