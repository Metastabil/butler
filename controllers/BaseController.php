<?php
namespace App\Controllers;

use System\Classes\Request;
use System\Classes\View;
use App\Models\LogModel;

/**
 * @author Julius Derigs
 * @version 1.1.0
 */

class BaseController {
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var View 
     */
    protected View $view;

    /**
     * @var LogModel
     */
    protected LogModel $log_model;

    /**
     * Constructor
     */
    public function __construct() {
        $this->log_model = new LogModel();
        $this->request = new Request();
        $this->view = new View();
    }

    /**
     * @param string $action
     * @param string $table_name
     * @param int $record_id
     * @param int $user_id
     * @return void
     */
    protected function log(string $action, string $table_name, int $record_id, int $user_id) :void {
        $input = [
            'action' => $action,
            'table_name' => $table_name,
            'record_id' => $record_id,
            'user_id' => $user_id
        ];

        $this->log_model->insert($input);
    }
}