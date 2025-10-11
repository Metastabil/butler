<?php

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

if (!function_exists('redirect_if_not_authenticated')) {
    /**
     * @return void
     */
    function redirect_if_not_authenticated() :void {
        if (empty($_SESSION['user'])) {
            redirect('login');
        }
    }
}