<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\UserModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Pages extends BaseController {
    /**
     * @var UserModel
     */
    private UserModel $user_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->user_model = new UserModel();
    }

    /**
     * @return void
     */
    public function login() :void {
        $data = [
            'title' => LANG->pages->titles->login
        ];

        $required_fields = [
            'username',
            'password'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $username = $this->request->get('username');
            $password = $this->request->get('password');
            $user = $this->user_model->select(0, $username);

            if (!empty($user) && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id']
                ];

                redirect('recipes');
            }

            set_msg(LANG->messages->error->credentials, 'error');

            redirect('login');
        }

        $this->view->render('pages/login', $data);
    }

    /**
     * @return void
     */
    #[NoReturn] public function logout() :void {
        redirect_if_not_authenticated();

        unset($_SESSION['user']);

        redirect('login');
    }
}