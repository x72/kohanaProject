<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Myapp extends Xyz_Controller
{

    public function action_index()
    {
        //name = Service_User::getUserName();
        $user = new Service_User();
        $name = $user->getUserName();

        $this->assign('name', $name);
        $this->display('index');
    }
}
