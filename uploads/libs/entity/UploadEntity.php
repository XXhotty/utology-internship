<?php
namespace libs\entity;

class UploadEntity
{
    public $id; // ユーザーID
    public $title; // ニックネーム
    public $created; // メールアドレス

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->created = $data['created'];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created' => $this->created,
        ];
    }
}