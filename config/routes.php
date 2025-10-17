<?php

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

$routes[] = ['Pages', 'login'];

// Categories
$routes['categories'] = ['Categories', 'index'];
$routes['create-category'] = ['Categories', 'create'];
$routes['show-category/:id'] = ['Categories', 'show'];
$routes['update-category/:id'] = ['Categories', 'update'];
$routes['delete-category/:id'] = ['Categories', 'delete'];

// Pages
$routes['login'] = ['Pages', 'login'];
$routes['logout'] = ['Pages', 'logout'];

// Recipes
$routes['recipes'] = ['Recipes', 'index'];
$routes['create-recipe'] = ['Recipes', 'create'];
$routes['show-recipe/:id'] = ['Recipes', 'show'];
$routes['update-recipe/:id'] = ['Recipes', 'update'];
$routes['delete-recipe/:id'] = ['Recipes', 'delete'];

// Users
$routes['users'] = ['Users', 'index'];
$routes['create-user'] = ['Users', 'create'];
$routes['show-user/:id'] = ['Users', 'show'];
$routes['update-user/:id'] = ['Users', 'update'];
$routes['delete-user/:id'] = ['Users', 'delete'];

return $routes;