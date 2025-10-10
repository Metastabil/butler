<?php
/**
 * @author Julius Derigs
 * @version 1.0.0
 */

if (!function_exists('set_msg')) {
    /**
     * @param string $msg
     * @param string $type
     * @return void
     */
    function set_msg(string $msg, string $type) :void {
        $_SESSION['msg'] = [
            'msg' => $msg,
            'type' => $type
        ];
    }
}

if (!function_exists('unset_msg')) {
    /**
     * @return void
     */
    function unset_msg() :void {
        unset($_SESSION['msg']);
    }
}