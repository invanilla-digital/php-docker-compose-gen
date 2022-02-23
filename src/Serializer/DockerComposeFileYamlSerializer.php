<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Serializer;

use Invanilla\DockerComposeGenerator\Configuration\Service;
use Invanilla\DockerComposeGenerator\File\DockerComposeFile;
use Ramsey\Collection\CollectionInterface;
use Symfony\Component\Yaml\Yaml;

class DockerComposeFileYamlSerializer implements DockerComposeFileSerializerInterface
{
    public function serialize(DockerComposeFile $dockerComposeFile): string
    {
        $config = [
            'version' => $dockerComposeFile->getVersion(),
        ];

        $config = array_merge($config, $this->getServiceConfig($dockerComposeFile));

        return Yaml::dump($config, 10, 2);
    }

    private function getServiceConfig(DockerComposeFile $dockerComposeFile): array
    {
        /** @var Service[]|CollectionInterface $services */
        $services = $dockerComposeFile->getServices();

        if ($services->isEmpty()) {
            return [];
        }

        $config = [];

        foreach ($services as $service) {
            $config[$service->getName()] = [
                'image' => $service->getImage(),
                'command' => $service->getCommand(),
                'environment' => $service->getEnvironment()->toArray()
            ];
        }

        return [
            'services' => $config
        ];
    }
}
