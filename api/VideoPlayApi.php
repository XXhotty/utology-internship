<?php

namespace api\controller;
include_once __DIR__ . '/../uploads.inc.php';
include_once __DIR__.'/controller/VideoPlayApi.php';
$controller = new VideoPlayApiController();
$controller->execute();