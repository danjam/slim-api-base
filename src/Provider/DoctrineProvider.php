<?php

declare(strict_types=1);

namespace SlimApiBase\Provider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Container as SlimContainer;

/**
 * Class DoctrineProvider
 *
 * @package SlimApiBase\Provider
 */
class DoctrineProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container[EntityManager::class] = function (SlimContainer $container): EntityManager {
            $settings = $container->get('settings')['doctrine'];

            $config = Setup::createAnnotationMetadataConfiguration(
                $settings['metadata_dirs'],
                $settings['dev_mode']
            );

            $config->setMetadataDriverImpl(
                new AnnotationDriver(new AnnotationReader(), $settings['metadata_dirs'])
            );

            $config->setMetadataCacheImpl(
                new FilesystemCache($settings['cache_dir'])
            );

            return EntityManager::create($settings['connection'], $config);
        };
    }
}
