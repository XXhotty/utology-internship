<?php
use uploads\controller\TestController;
include_once __DIR__ . '/../uploads.inc.php';
$controller = new TestController();
$controller->execute();