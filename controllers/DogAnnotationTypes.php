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

        $this->dog_annotation_type_model = new DogAnnotationTypeModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->dog_annotation_type_model->select();
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
            'title' => LANG->dog_annotation_types->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render_header($data)
                   ->render('dog-annotation-types/index', $data)
                   ->render_footer();
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

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'name' => (string)$this->request->get('name')
            ];

            $response = $this->dog_annotation_type_model->insert($input);

            if ($response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('dog-annotation-types');
        }

        $this->view->render_header($data)
                   ->render('dog-annotation-types/create', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->dog_annotation_types->titles->show,
            'element' => $this->dog_annotation_type_model->select($id)
        ];

        $this->view->render_header($data)
                   ->render('dog-annotation-types/show', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->dog_annotation_types->titles->update,
            'element' => $this->dog_annotation_type_model->select($id)
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'id' => $id,
                'name' => (string)$this->request->get('name'),
                'deleted' => 0
            ];

            if ($this->dog_annotation_type_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('dog-annotation-types');
        }

        $this->view->render_header($data)
                   ->render('dog-annotation-types/update', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->dog_annotation_type_model->select($id);
        $input = [
            'id' => $id,
            'name' => $element['name'],
            'deleted' => 1
        ];

        if ($this->dog_annotation_type_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('dog-annotation-types');
    }
}