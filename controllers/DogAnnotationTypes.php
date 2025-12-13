<?php

namespace App\Controllers;

use App\Models\DogAnnotationTypeModel;
use JetBrains\PhpStorm\NoReturn;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class DogAnnotationTypes extends BaseController {
    /**
     * @var DogAnnotationTypeModel
     */
    private DogAnnotationTypeModel $dog_annotation_type_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        redirect_if_not_authenticated();
        redirect_if_not_administrator();

        $this->dog_annotation_type_model = new DogAnnotationTypeModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $data = [
            'title' => LANG->dog_annotation_types->titles->index,
            'elements' => $this->dog_annotation_type_model->select()
        ];

        $this->view->render('templates/header', $data)
                   ->render('dog-annotation-types/index', $data)
                   ->render('templates/footer');
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->dog_annotation_types->titles->create
        ];

        $required_fields = [
            'name'
        ];
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