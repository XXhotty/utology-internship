<?php
use uploads\controller\VideoListController;
include_once __DIR__ . '/../uploads.inc.php';
$controller = new VideoListController();
$controller->execute();