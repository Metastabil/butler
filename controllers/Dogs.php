<?php

namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\DogModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Dogs extends BaseController {
    private DogModel $dog_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->dog_model = new DogModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $data = [
            'title' => LANG->dogs->titles->index,
            'elements' => $this->dog_model->select()
        ];

        $this->view->render('templates/header', $data)
                   ->render('dogs/index', $data)
                   ->render('templates/footer');
    }

    /**
     * @return void
     */
    public function create() :void {
        // TODO
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