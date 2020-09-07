<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

function createEntityManager()
{
    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;
    $config = Setup::createAnnotationMetadataConfiguration(
        [__DIR__ . '/../app/Model'],
        $isDevMode,
        $proxyDir,
        $cache,
        $useSimpleAnnotationReader
    );

    $conn = [
        'driver' => 'pdo_mysql',
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'dbname' => $_ENV['DB_NAME'],
    ];

    $entityManager = EntityManager::create($conn, $config);

    return $entityManager;
}