<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\UserModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Users extends BaseController {
    /**
     * @var string
     */
    private string $table = 'users';

    /**
     * @var UserModel
     */
    private UserModel $user_model;

    /**
     * @var int
     */
    private int $user_id;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        redirect_if_not_authenticated();
        redirect_if_not_administrator();

        $this->user_id = $_SESSION['user']['id'];
        $this->user_model = new UserModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $data = [
            'title' => LANG->users->titles->index,
            'elements' => $this->user_model->select()
        ];

        $this->view->render('templates/header', $data)
                   ->render('users/index', $data)
                   ->render('templates/footer');
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->users->titles->create
        ];

        $required_fields = [
            'username',
            'password'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'username' => $this->request->get('username'),
                'password' => password_hash($this->request->get('password'), PASSWORD_DEFAULT),
                'administrator' => (int)(bool)$this->request->get('administrator')
            ];

            $response = $this->user_model->insert($input);

            if ((int)$response > 0) {
                set_msg(LANG->messages->success->save, 'success');

                $this->log(LANG->log->create, $this->table, $response, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('users');
        }

        $this->view->render('templates/header', $data)
                   ->render('users/create', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->users->titles->show,
            'element' => $this->user_model->select($id),
            'logs' => $this->log_model->select($this->table, $id)
        ];

        $this->view->render('templates/header', $data)
                   ->render('users/show', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->users->titles->update,
            'element' => $this->user_model->select($id)
        ];

        $required_fields = [
            'username'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'id' => $id,
                'username' => $this->request->get('username'),
                'password' => $data['element']['password'],
                'administrator' => (int)(bool)$this->request->get('administrator'),
                'deleted' => 0
            ];

            if (!empty($this->request->get('password'))) {
                $input['password'] = password_hash($this->request->get('password'), PASSWORD_DEFAULT);
            }

            if ($this->user_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');

                $this->log(LANG->log->update, $this->table, $id, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('users');
        }

        $this->view->render('templates/header', $data)
                   ->render('users/update', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->user_model->select($id);
        $input = [
            'id' => $id,
            'username' => $element['username'],
            'password' => $element['password']
        ];

        if ($this->user_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');

            $this->log(LANG->log->update, $this->table, $id, $this->user_id);
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('users');
    }
}