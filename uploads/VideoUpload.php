<?php
use uploads\controller\VideoUploadController;
include_once __DIR__ . '/../uploads.inc.php';
$controller = new VideoUploadController();
$controller->execute();