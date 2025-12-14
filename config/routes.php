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

// Dogs
$routes['dogs'] = ['Dogs', 'index'];
$routes['create-dog'] = ['Dogs', 'create'];
$routes['show-dog/:id'] = ['Dogs', 'show'];
$routes['update-dog/:id'] = ['Dogs','update'];
$routes['delete-dog/:id'] = ['Dogs', 'delete'];

// Medical Dog Data
$routes['create-medical-dog-data/:dog_id'] = ['MedicalDogData', 'create'];
$routes['show-medical-dog-data/:id'] = ['MedicalDogData', 'show'];
$routes['update-medical-dog-data/:id'] = ['MedicalDogData', 'update'];
$routes['delete-medical-dog-data/:id'] = ['MedicalDogData', 'delete'];

// Pages
$routes['login'] = ['Pages', 'login'];
$routes['logout'] = ['Pages', 'logout'];
$routes['profile'] = ['Pages', 'profile'];

// Recipes
$routes['recipes'] = ['Recipes', 'index'];
$routes['create-recipe'] = ['Recipes', 'create'];
$routes['show-recipe/:id'] = ['Recipes', 'show'];
$routes['update-recipe/:id'] = ['Recipes', 'update'];
$routes['delete-recipe/:id'] = ['Recipes', 'delete'];

// Stones
$routes['stones'] = ['Stones', 'index'];
$routes['discover'] = ['Stones', 'discover'];
$routes['create-stone'] = ['Stones', 'create'];
$routes['show-stone/:id'] = ['Stones', 'show'];
$routes['update-stone/:id'] = ['Stones', 'update'];
$routes['delete-stone/:id'] = ['Stones', 'delete'];
$routes['adventskalender'] = ['Stones', 'discover'];

// Users
$routes['users'] = ['Users', 'index'];
$routes['create-user'] = ['Users', 'create'];
$routes['show-user/:id'] = ['Users', 'show'];
$routes['update-user/:id'] = ['Users', 'update'];
$routes['delete-user/:id'] = ['Users', 'delete'];

return $routes;