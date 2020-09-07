<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once(__DIR__ . '/db-bootstrap.php');

// replace with mechanism to retrieve EntityManager in your app
$entityManager = createEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
