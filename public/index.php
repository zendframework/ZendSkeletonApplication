<?php

// Create application, bootstrap, and run
$bootstrap = include 'bootstrap.php';
$application = new Zend\Mvc\Application();
$bootstrap->bootstrap($application);
$application->run()->send();