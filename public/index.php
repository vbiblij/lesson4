<?php
require_once '/var/www/html/lesson4/vendor/autoload.php';

$config = require_once '../config.php';

$application = new \App\Application($config);
$application->run();

?>