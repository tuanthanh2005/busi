<?php
// Ensure we are in the public directory context for relative paths
chdir(__DIR__);

// Autoload Core Classes
require_once '../app/config/config.php';
require_once '../app/Core/App.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Database.php';

// Initialize the Application
$app = new App;
