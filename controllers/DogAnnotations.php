<?php
namespace App\Controllers;

use App\Models\DogAnnotationTypeModel;
use App\Models\DogAnnotationModel;
use App\Models\DogModel;
use JetBrains\PhpStorm\NoReturn;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class DogAnnotations extends BaseController {
    /**
     * @var DogAnnotationTypeModel
     */
    private DogAnnotationTypeModel $dog_annotation_type_model;

    /**
     * @var DogAnnotationModel
     */
    private DogAnnotationModel $dog_annotation_model;

    /**
     * @var DogModel
     */
    private DogModel $dog_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->dog_annotation_type_model = new DogAnnotationTypeModel();
        $this->dog_annotation_model = new DogAnnotationModel();
        $this->dog_model = new DogModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->dog_annotation_model->select();
        $filtered_elements = [];
        $search = '';

        if ($this->request->is('post')) {
            $search = $this->request->get('search');

            if (!empty($search)) {
                foreach ($elements as $e) {
                    if (str_contains(strtolower($e['text']), strtolower($search)) || str_contains(strtolower($e['dog_name']), strtolower($search))) {
                        $filtered_elements[] = $e;
                    }
                }
            }
        }


        $data = [
            'title' => LANG->dog_annotations->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'dog_annotation_types' => $this->dog_annotation_type_model->select(),
            'dogs' => $this->dog_model->select(),
            'search' => $search
        ];

        $this->view->render_header($data)
                   ->render('dog-annotations/index', $data)
                   ->render_footer();
    }

    /**
     * @param int $dog_id
     * @return void
     */
    public function create(int $dog_id = 0) :void {
        $data = [
            'title' => LANG->dog_annotations->titles->create,
            'dog_annotation_types' => $this->dog_annotation_type_model->select(),
            'dogs' => $this->dog_model->select(),
            'dog_id' => $dog_id
        ];

        $required_fields = [
            'text'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'text' => (string)$this->request->get('text'),
                'dog_id' => (int)$this->request->get('dog'),
                'dog_annotation_type_id' => (int)$this->request->get('dog-annotation-type')
            ];

            $response = $this->dog_annotation_model->insert($input);

            if ($response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            if ($dog_id > 0) {
                redirect('show-dog/' . $dog_id);
            }

            redirect('dog-annotations');
        }

        $this->view->render_header($data)
                   ->render('dog-annotations/create', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->dog_annotations->titles->show,
            'dog_annotation_types' => $this->dog_annotation_type_model->select(),
            'dogs' => $this->dog_model->select(),
            'element' => $this->dog_annotation_model->select($id)
        ];

        $this->view->render_header($data)
                   ->render('dog-annotations/show', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->dog_annotations->titles->update,
            'element' => $this->dog_annotation_model->select($id),
            'dog_annotation_types' => $this->dog_annotation_type_model->select(),
            'dogs' => $this->dog_model->select()
        ];

        $required_fields = [
            'text'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'id' => $id,
                'text' => (string)$this->request->get('text'),
                'dog_id' => (int)$this->request->get('dog'),
                'dog_annotation_type_id' => (int)$this->request->get('dog-annotation-type'),
                'deleted' => 0
            ];

            if ($this->dog_annotation_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('show-dog/' . $data['element']['dog_id']);
        }

        $this->view->render_header($data)
                   ->render('dog-annotations/update', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->dog_annotation_model->select($id);
        $input = [
            'id' => $id,
            'text' => $element['text'],
            'dog_id' => $element['dog_id'],
            'dog_annotation_type_id' => $element['dog_annotation_type_id'],
            'deleted' => 1
        ];

        if ($this->dog_annotation_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('show-dog/' . $element['dog_id']);
    }
}