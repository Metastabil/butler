<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\CategoryModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Categories extends BaseController {
    /**
     * @var string
     */
    private string $table = 'categories';

    /**
     * @var CategoryModel
     */
    private CategoryModel $category_model;

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

        $this->user_id = $_SESSION['user']['id'];
        $this->category_model = new CategoryModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->category_model->select();
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
            'title' => LANG->categories->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render_header($data)
                   ->render('categories/index', $data)
                   ->render_footer();
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->categories->titles->create
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'name' => $this->request->get('name')
            ];

            $response = $this->category_model->insert($input);

            if ((int)$response > 0) {
                set_msg(LANG->messages->success->save, 'success');

                $this->log(LANG->log->create, $this->table, $response, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('categories');
        }

        $this->view->render_header($data)
                   ->render('categories/create', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->categories->titles->show,
            'element' => $this->category_model->select($id)
        ];

        $this->view->render_header($data)
                   ->render('categories/show', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {
        $data = [
            'title' => LANG->categories->titles->update,
            'element' => $this->category_model->select($id)
        ];

        $required_fields = [
            'name'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'id' => $id,
                'name' => $this->request->get('name'),
                'deleted' => 0
            ];

            if ($this->category_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');

                $this->log(LANG->log->update, $this->table, $id, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('categories');
        }

        $this->view->render_header($data)
                   ->render('categories/update', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->category_model->select($id);
        $input = [
            'id' => $id,
            'name' => $element['name'],
            'deleted' => 1
        ];

        if ($this->category_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');

            $this->log(LANG->log->update, $this->table, $id, $this->user_id);
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('categories');
    }
}