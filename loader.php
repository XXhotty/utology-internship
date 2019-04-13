<?php

require_once __DIR__ . '/libs/dao/Database.php';

requireDir(__DIR__ . '/libs/config');
requireDir(__DIR__ . '/libs/dao');
requireDir(__DIR__ . '/libs/entity');
requireDir(__DIR__ . '/libs/service');
requireDir(__DIR__ . '/libs/smarty');
requireDir(__DIR__ . '/libs/util');

require_once __DIR__ . '/uploads/controller/UploadsBaseController.php';
requireDir(__DIR__ . '/uploads/controller');

require_once __DIR__ . '/api/controller/ApiBaseController.php';
requireDir(__DIR__ . '/api/controller');

function requireDir($dir)
{
    foreach (glob("$dir/*") as $file) {
        if (!is_dir($file)) {
            require_once $file;
        }
    }
}
