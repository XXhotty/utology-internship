<?php

namespace libs\smarty;

include_once __DIR__ . '/../../libs/Smarty.class.php';

class UploadsSmarty
{
    public static function getSmarty()
    {
        $smarty = new \Smarty();
        $smarty->escape_html = true;
        $smarty->template_dir = __DIR__ . '/../../templates';
        $smarty->compile_dir = __DIR__ . '/../../templates_c';
        return $smarty;
    }
}