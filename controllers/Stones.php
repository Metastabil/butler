<?php
namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;
use App\Models\StoneModel;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class Stones extends BaseController {
    /**
     * @var StoneModel
     */
    private StoneModel $stone_model;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        redirect_if_not_authenticated();

        $this->stone_model = new StoneModel();
    }

    /**
     * @return void
     */
    public function index() :void {
        $elements = $this->stone_model->select();
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
            'title' => LANG->stones->titles->index,
            'elements' => empty($filtered_elements) && empty($search) ? $elements : $filtered_elements,
            'search' => $search
        ];

        $this->view->render_header($data)
                   ->render('stones/index', $data)
                   ->render_footer();
    }

    public function discover() :void {
        $data = [
            'title' => LANG->stones->titles->advent_calendar
        ];

        $required_fields = [
            'number'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $number = $this->request->get('number');
            $element = $this->stone_model->select(0, $number);

            if (!empty($element)) {
                redirect("show-stone/{$element['id']}");
            }

            set_msg(LANG->messages->error->unknown_number, 'error');

            redirect('discover');
        }

        $this->view->render_header($data)
                   ->render('stones/discover', $data)
                   ->render_footer();
    }

    /**
     * @return void
     */
    public function create() :void {
        $data = [
            'title' => LANG->stones->titles->create
        ];

        $required_fields = [
            'number',
            'name',
            'rarity',
            'description'
        ];

        if ($this->request->is('post') && $this->request->validate($required_fields)) {
            $input = [
                'number' => (int)$this->request->get('number'),
                'name' => $this->request->get('name'),
                'rarity' => $this->request->get('rarity'),
                'description' => $this->request->get('description')
            ];

            if ($this->stone_model->insert($input)) {
                set_msg(LANG->messages->success->save, 'success');
            }
            else {
                set_msg(LANG->messages->error->save, 'error');
            }

            redirect('stones');
        }

        $this->view->render_header($data)
                   ->render('stones/create', $data)
                   ->render_footer();
    }

    /**
     * @param int $id
     * @return void
     */
    public function show(int $id) :void {
        $data = [
            'title' => LANG->stones->titles->show,
            'element' => $this->stone_model->select($id)
        ];

        $this->view->render_header($data)
                   ->render('stones/show', $data)
                   ->render_footer();
    }
}