<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Serializer;

use Invanilla\DockerComposeGenerator\File\DockerComposeFile;

interface DockerComposeFileSerializerInterface
{
    public function serialize(DockerComposeFile $dockerComposeFile): string;
}
