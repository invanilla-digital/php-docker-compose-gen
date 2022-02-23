<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Tests\Unit;

use Invanilla\DockerComposeGenerator\Configuration\Service;
use Invanilla\DockerComposeGenerator\File\DockerComposeFile;
use Invanilla\DockerComposeGenerator\Serializer\DockerComposeFileSerializerInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Collection\Collection;
use Ramsey\Collection\Map\TypedMap;

abstract class AbstractDockerComposeFileSerializerTestCase extends TestCase
{
    protected DockerComposeFileSerializerInterface $serializer;

    protected function setUp(): void
    {
        $this->serializer = $this->getImplementation();
    }

    abstract protected function getImplementation(): DockerComposeFileSerializerInterface;

    public function testItCanSerializeFileWithOnlyVersionSpecified(): void
    {
        $file = new DockerComposeFile('3');

        self::assertStringEqualsFile(
            __DIR__ . '/Fixtures/docker-compose-with-only-version.yaml',
            $this->serializer->serialize($file)
        );
    }

    public function testItCanSerializeFileWithBasicServiceConfiguration(): void
    {
        $file = new DockerComposeFile(
            '3',
            new Collection(
                Service::class,
                [
                    new Service(
                        'test',
                        'example',
                        'hello world',
                        new TypedMap('string', 'string', ['MYSQL_HOST' => 'localhost']),
                        new Collection('string')
                    )
                ]
            )
        );

        self::assertStringEqualsFile(
            __DIR__ . '/Fixtures/docker-compose-with-basic-service-config.yaml',
            $this->serializer->serialize($file)
        );
    }
}
