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

if (!function_exists('is_administrator')) {
    /**
     * @return bool
     */
    function is_administrator() :bool {
        return $_SESSION['user']['administrator'];
    }
}

if (!function_exists('redirect_if_not_administrator')) {
    function redirect_if_not_administrator() :void {
        if (!is_administrator()) {
            redirect('recipes');
        }
    }
}