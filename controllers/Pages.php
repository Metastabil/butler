<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\FavoriteModel;
use App\Models\UserModel;
use App\Models\DogModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Pages extends BaseController {
    /**
     * @var FavoriteModel
     */
    private FavoriteModel $favorite_model;

    /**
     * @var UserModel
     */
    private UserModel $user_model;

    /**
     * @var DogModel
     */
    private DogModel $dog_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->favorite_model = new FavoriteModel();
        $this->user_model = new UserModel();
        $this->dog_model = new DogModel();
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
                    'id' => $user['id'],
                    'administrator' => $user['administrator']
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

    /**
     * @return void
     */
    public function profile() :void {
        redirect_if_not_authenticated();

        $user_id = $_SESSION['user']['id'];

        $data = [
            'title' => LANG->pages->titles->profile,
            'user' => $this->user_model->select($user_id),
            'favorites' => $this->favorite_model->select(0, $user_id),
            'dogs' => $this->dog_model->select(0, $user_id)
        ];

        $this->view->render('templates/header', $data)
                   ->render('pages/profile', $data)
                   ->render('templates/footer');
    }
}