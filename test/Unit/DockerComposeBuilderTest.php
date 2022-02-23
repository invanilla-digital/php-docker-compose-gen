<?php

declare(strict_types=1);

namespace Invanilla\DockerComposeGenerator\Tests\Unit;

use Invanilla\DockerComposeGenerator\Builder\DockerComposeBuilder;
use Invanilla\DockerComposeGenerator\Builder\ServiceBuilder;
use Invanilla\DockerComposeGenerator\Configuration\Service;
use Invanilla\DockerComposeGenerator\File\DockerComposeFile;
use PHPUnit\Framework\TestCase;
use Ramsey\Collection\Collection;
use Ramsey\Collection\Map\TypedMap;

class DockerComposeBuilderTest extends TestCase
{
    protected DockerComposeBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new DockerComposeBuilder();
    }

    public function testItCanBuildAComposeFileWithOnlyVersionSpecified(): void
    {
        $this->builder->version('3');

        self::assertEquals(
            new DockerComposeFile('3'),
            $this->builder->build()
        );
    }

    public function testItCanBuildAComposeFileWithBasicServiceDefinition(): void
    {
        $this->builder
            ->version('3')
            ->service(static function (ServiceBuilder $service): ServiceBuilder {
                return $service
                    ->name('test')
                    ->env('MYSQL_HOST', 'localhost')
                    ->command('hello world')
                    ->image('example');
            });

        self::assertEquals(
            new DockerComposeFile(
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
            ),
            $this->builder->build()
        );
    }

}
