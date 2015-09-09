<?php
/**
 * Force an internal server error as the default response.
 */
header('HTTP/1.1 500 Internal Error Error', true, 500);

$app = require __DIR__.'/../src/bootstrap.php';

$app->run();