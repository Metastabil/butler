<?php
namespace App\Controllers;

use App\Models\RecipeCategoryAssignmentModel;
use JetBrains\PhpStorm\NoReturn;
use App\Models\CategoryModel;
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
     * @var RecipeCategoryAssignmentModel
     */
    private RecipeCategoryAssignmentModel $recipe_category_assignment_model;

    /**
     * @var CategoryModel
     */
    private CategoryModel $category_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        redirect_if_not_authenticated();

        $this->user_id = $_SESSION['user']['id'];
        $this->recipe_model = new RecipeModel();
        $this->recipe_category_assignment_model = new RecipeCategoryAssignmentModel();
        $this->category_model = new CategoryModel();
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
            'title' => LANG->recipes->titles->create,
            'categories' => $this->category_model->select()
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
                $categories = $this->request->get('categories');

                foreach ($categories as $c) {
                    $category_input = [
                        'recipe_id' => $response,
                        'category_id' => $c
                    ];

                    $this->recipe_category_assignment_model->insert($category_input);
                }

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
        $element = $this->recipe_model->select($id);
        $selected_categories = explode(',', $element['category_ids']);

        $data = [
            'title' => LANG->recipes->titles->update,
            'element' => $element,
            'categories' => $this->category_model->select(),
            'selected_categories' => $selected_categories
        ];

        $required_fields = [
            'name',
            'ingredients',
            'description'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $base64_string = $data['element']['image'];

            if (!empty($_FILES['image']['tmp_name'])) {
                $file_tmp_path = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                $file_content = file_get_contents($file_tmp_path);
                $base64_string = base64_encode($file_content);
                $base64_string = "data:$file_type;base64,$base64_string";

                $max_size = 2 * 1024 * 1024; // 2 MB
                if ($_FILES['image']['size'] > $max_size) {
                    set_msg('Datei ist zu groß! Maximal 2 MB erlaubt.', 'error');

                    redirect('recipes');
                }
            }

            $input = [
                'id' => $id,
                'name' => $this->request->get('name'),
                'ingredients' => $this->request->get('ingredients'),
                'description' => $this->request->get('description'),
                'image' => $base64_string,
                'deleted' => 0
            ];

            if ($this->recipe_model->update($input)) {
                set_msg(LANG->messages->success->update, 'success');

                foreach ($selected_categories as $sc) {
                    $this->delete_assigned_categories($id, (int)$sc);
                }

                $new_selected_categories = $this->request->get('categories');

                foreach ($new_selected_categories as $nsc) {
                    $new_category_input = [
                        'recipe_id' => $id,
                        'category_id' => $nsc
                    ];

                    $this->recipe_category_assignment_model->insert($new_category_input);
                }

                $this->log(LANG->log->update, $this->table, $id, $this->user_id);
            }
            else {
                set_msg(LANG->messages->error->update, 'error');
            }

            redirect('recipes');
        }

        $this->view->render('templates/header', $data)
                   ->render('recipes/update', $data)
                   ->render('templates/footer');
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

    /**
     * @param $recipe_id
     * @param $category_id
     * @return bool
     */
    private function delete_assigned_categories($recipe_id, $category_id) :bool {
        $input = [
            'recipe_id' => $recipe_id,
            'category_id' => $category_id
        ];

        return $this->recipe_category_assignment_model->delete_by_recipe_id($input);
    }
}