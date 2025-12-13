<?php

namespace App\Controllers;

use App\Models\MedicalDogDataModel;
use JetBrains\PhpStorm\NoReturn;
use App\Models\UserModel;
use App\Models\DogModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Dogs extends BaseController {
    /**
     * @var MedicalDogDataModel
     */
    private MedicalDogDataModel $medical_dog_data_model;

    /**
     * @var DogModel
     */
    private DogModel $dog_model;

    /**
     * @var UserModel
     */
    private UserModel $user_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->medical_dog_data_model = new MedicalDogDataModel();
        $this->dog_model = new DogModel();
        $this->user_model = new UserModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->dog_model->select();
        $filtered_elements = [];
        $search = '';

        if ($this->request->is('post')) {
            $search = $this->request->get('search');

            if (!empty($search)) {
                foreach ($elements as $e) {
                    if (str_contains(strtolower($e['name']), strtolower($search))) {
                        $filtered_elements[] = $e;
                    }
                }
            }
        }

        $data = [
            'title' => LANG->dogs->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render('templates/header', $data)
                   ->render('dogs/index', $data)
                   ->render('templates/footer');
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->dogs->titles->create,
            'users' => $this->user_model->select()
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'name' => $this->request->get('name'),
                'user_id' => (int)$this->request->get('user-id')
            ];

            $response = $this->dog_model->insert($input);

            if ((int)$response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('dogs');
        }

        $this->view->render('templates/header', $data)
                   ->render('dogs/create', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->dogs->titles->show,
            'element' => $this->dog_model->select($id),
            'users' => $this->user_model->select(),
            'medical_dog_data' => $this->medical_dog_data_model->select(0, $id)
        ];

        $this->view->render('templates/header', $data)
                   ->render('dogs/show', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        // TODO
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id) :void {
        // TODO
    }
}