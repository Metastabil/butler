<?php
namespace App\Controllers;

use App\Models\DogAnnotationTypeModel;
use App\Models\DogAnnotationModel;
use JetBrains\PhpStorm\NoReturn;
use App\Models\UserModel;
use App\Models\DogModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Dogs extends BaseController {
    /**
     * @var DogAnnotationTypeModel
     */
    private DogAnnotationTypeModel $dog_annotation_type_model;

    /**
     * @var DogAnnotationModel
     */
    private DogAnnotationModel $dog_annotation_model;

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

        redirect_if_not_authenticated();

        $this->dog_annotation_type_model = new DogAnnotationTypeModel();
        $this->dog_annotation_model = new DogAnnotationModel();
        $this->user_model = new UserModel();
        $this->dog_model = new DogModel();
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

        $this->view->render_header($data)
                   ->render('dogs/index', $data)
                   ->render_footer();
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
                'name' => (string)$this->request->get('name'),
                'user_id' => (int)$this->request->get('user')
            ];

            $response = $this->dog_model->insert($input);

            if ($response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('dogs');
        }

        $this->view->render_header($data)
                   ->render('dogs/create', $data)
                   ->render_footer();
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
            'dog_annotations' => $this->dog_annotation_model->select(0, $id),
            'dog_annotation_types' => $this->dog_annotation_type_model->select()
        ];

        $this->view->render_header($data)
                   ->render('dogs/show', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->dogs->titles->update,
            'element' => $this->dog_model->select($id),
            'users' => $this->user_model->select()
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'id' => $id,
                'name' => (string)$this->request->get('name'),
                'user_id' => (int)$this->request->get('user'),
                'deleted' => 0
            ];

            if ($this->dog_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('dogs');
        }

        $this->view->render_header($data)
                   ->render('dogs/update', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->dog_model->select($id);
        $input = [
            'id' => $id,
            'name' => $element['name'],
            'user_id' => $element['user_id'],
            'deleted' => 1
        ];

        if ($this->dog_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('dogs');
    }
}