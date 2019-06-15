<?php
namespace uploads\controller;
use libs\smarty\UploadsSmarty;
class UploadsBaseController
{
    protected $smarty;
    protected $template = '';


    public function __construct()
    {
        $this->smarty = UploadsSmarty::getSmarty();
    }

    public function execute()
    {
        $this->beforeMain();
        $this->main();
        $this->afterMain();
        try {
            $this->smarty->display($this->template);
        } catch (\Exception $e) {
            throw $e;
        }
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