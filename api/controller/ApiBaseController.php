<?php
namespace api\controller;
use libs\smarty\UploadsSmarty;

class ApiBaseController
{


    /** @var UploadsDao */
    protected $UploadsDao;

    public function __construct()
    {
        $this->smarty = UploadsSmarty::getSmarty();
    }

    public function execute()
    {
        $this->beforeMain();
        $this->main();
        $this->afterMain();
    }
    protected function beforeMain()
    {
    }

    protected function main()
    {
    }

    protected function afterMain()
    {
    }
}