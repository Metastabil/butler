<?php
namespace System\Classes;

/**
 * @author Julius Derigs
 * @version 2.0.0
 */

class View {
    /**
     * @param string $view
     * @param array $params
     * @return $this
     */
    public function render(string $view, array $params = []) :self {
        $viewDirectory = dirname(__DIR__, 2) . '/views';
        $viewPath = "$viewDirectory/$view.php";
        extract($params);

        ob_start();

        include $viewPath;

        echo ob_get_clean();

        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function render_header(array $params = []) :self {
        $this->render('templates/header', $params);

        return $this;
    }

    /**
     * @param array $params
     * @return self
     */
    public function render_footer(array $params = []) :self {
        $this->render('templates/footer', $params);

        return $this;
    }
}