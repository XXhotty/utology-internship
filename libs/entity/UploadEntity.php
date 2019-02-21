<?php
namespace libs\entity;

use libs\config\InviteConfig;

class UserEntity
{
    public $id; // ユーザーID
    public $nickname; // ニックネーム
    public $mail; // メールアドレス

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->nickname = $data['nickname'];
        $this->mail = $data['mail'];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'mail' => $this->mail,
        ];
    }
}