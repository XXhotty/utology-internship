<?php
namespace manage\controller\account_manage;

use manage\controller\ManageBaseController;

class CreateController extends ManageBaseController
{
    protected $template = 'manage/account_manage/create.tpl';

    protected $authorization = 'root';

    protected function main()
    {
        $errors = [];
        $name = InputUtil::extractString('name', '名前', $errors);
        $mail = InputUtil::extractString('mail', 'メールアドレス', $errors);
        $authorization = InputUtil::extractString('authorization', '権限', $errors);
        $mode = InputUtil::extractMode();

        $this->smarty->assign('name', $name);
        $this->smarty->assign('mail', $mail);
        $this->smarty->assign('authorization', $authorization);
        $this->smarty->assign('messages', []);
        $this->smarty->assign('errors', $errors);
        if ($mode == 'input') {
            $this->smarty->assign('errors', []);
        } else if ($mode == 'commit') {
            if (empty($errors)) {
                if (!empty($this->accountDao->findByMail($mail))) {
                    $this->smarty->assign('errors', ["$mail はすでに登録されています"]);
                } else {
                    $password = uniqid();
                    $this->accountDao->create($name, $mail, SessionUtil::getHash($password), $authorization);
                    $this->smarty->assign('messages', ["アカウント登録が完了しました（password: {$password}）"]);
                }
            }
        }
    }
}