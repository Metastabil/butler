<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\ModuleModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Modules extends BaseController {
    /**
     * @var ModuleModel
     */
    private ModuleModel $module_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        redirect_if_not_authenticated();
        redirect_if_not_administrator();

        $this->module_model = new ModuleModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->module_model->select();
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
            'title' => LANG->modules->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render_header($data)
                   ->render('modules/index', $data)
                   ->render_footer();
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->modules->titles->create
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'name' => (string)$this->request->get('name')
            ];

            $response = $this->module_model->insert($input);

            if ($response > 0) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('modules');
        }

        $this->view->render_header($data)
                   ->render('modules/create', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->modules->titles->show,
            'element' => $this->module_model->select($id)
        ];

        $this->view->render_header($data)
                   ->render('modules/show', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->modules->titles->update,
            'element' => $this->module_model->select($id)
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

            if ($this->module_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('modules');
        }

        $this->view->render_header($data)
                   ->render('modules/update', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->module_model->select($id);
        $input = [
            'id' => $id,
            'name' => $element['name'],
            'deleted' => 1
        ];

        if ($this->module_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('modules');
    }
}