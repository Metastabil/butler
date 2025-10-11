<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\RecipeModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Recipes extends BaseController {
    /**
     * @var string
     */
    private string $table = 'recipes';

    /**
     * @var RecipeModel
     */
    private RecipeModel $recipe_model;

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
        $this->recipe_model = new RecipeModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->recipe_model->select();
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
            'title' => LANG->recipes->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render('templates/header', $data)
                   ->render('recipes/index', $data)
                   ->render('templates/footer');
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->recipes->titles->create
        ];

        $required_fields = [
            'name',
            'ingredients',
            'description'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $file_tmp_path = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_content = file_get_contents($file_tmp_path);
            $base64_string = base64_encode($file_content);

            $max_size = 2 * 1024 * 1024; // 2 MB
            if ($_FILES['image']['size'] > $max_size) {
                set_msg('Datei ist zu groß! Maximal 2 MB erlaubt.', 'error');

                redirect('recipes');
            }

            $input = [
                'name' => $this->request->get('name'),
                'ingredients' => $this->request->get('ingredients'),
                'description' => $this->request->get('description'),
                'image' => "data:$file_type;base64,$base64_string"
            ];

            $response = $this->recipe_model->insert($input);

            if ($response > 0) {
                set_msg(LANG->messages->success->save, 'success');

                $this->log(LANG->log->create, $this->table, $response, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('recipes');
        }

        $this->view->render('templates/header', $data)
                   ->render('recipes/create', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->recipes->titles->show,
            'element' => $this->recipe_model->select($id),
            'logs' => $this->log_model->select($this->table, $id)
        ];

        $this->view->render('templates/header', $data)
                   ->render('recipes/show', $data)
                   ->render('templates/footer');
    }

    /**
     * @param int $id
     * @return void
     */
    public function update(int $id) :void {

    }

    /**
     * @param int $id
     * @return void
     */
    #[NoReturn] public function delete(int $id) :void {
        $element = $this->recipe_model->select($id);
        $input = [
            'id' => $id,
            'name' => $element['name'],
            'ingredients' => $element['ingredients'],
            'description' => $element['description'],
            'image' => $element['image'],
            'deleted' => 1
        ];

        if ($this->recipe_model->update($input)) {
            set_msg(LANG->messages->success->delete, 'success');

            $this->log(LANG->log->update, $this->table, $id, $this->user_id);
        }
        else {
            set_msg(LANG->messages->error->delete, 'error');
        }

        redirect('recipes');
    }
}