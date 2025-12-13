<?php

namespace App\Controllers;

use App\Models\MedicalDogDataModel;
use JetBrains\PhpStorm\NoReturn;
use App\Models\DogModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class MedicalDogData extends BaseController {
    /**
     * @var MedicalDogDataModel
     */
    private MedicalDogDataModel $medical_dog_data_model;

    /**
     * @var DogModel
     */
    private DogModel $dog_model;

    public function __construct() {
        parent::__construct();

        $this->medical_dog_data_model = new MedicalDogDataModel();
        $this->dog_model = new DogModel();
    }

    /**
     * @param int $dog_id
     * @return void
     */
    public function create(int $dog_id) :void {
        $data = [
            'title' => LANG->medical_dog_data->titles->create,
            'dogs' => $this->dog_model->select(),
            'dog_id' => $dog_id
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'name' => $this->request->get('name'),
                'description' => $this->request->get('description'),
                'date' => $this->request->get('date'),
                'dog_id' => $dog_id
            ];

            $response = $this->medical_dog_data_model->insert($input);

            if ((int)$response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('show-dog/' . $dog_id);
        }

        $this->view->render('templates/header', $data)
                   ->render('medical-dog-data/create', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        // TODO
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