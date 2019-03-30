<?php
namespace libs\util;

class UploadsUtil
{

    static public function extractString($key, $keyName, &$errors, $isExist = true)
    {
        $value = isset($_REQUEST[$key]) ? $_REQUEST[$key] : '';
        if (!is_string($value)) {
            $errors[$key] = $keyName . 'が不正です。';
            return '';
        }
        $value = trim($value);
        if ($isExist && $value == '') {
            $errors[$key] = $keyName . 'が入力されていません。';
            return '';
        } else if ($value == '') {
            return '';
        }
        return $value;
    }
}