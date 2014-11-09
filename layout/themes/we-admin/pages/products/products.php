<?php

/*
 * Produtos
 */
//Listagem de Produtos
require_page('products', 'pages/products/products_list.php');
//Cadastro de Produtos
require_page('products/register', 'pages/products/product_register.php');
//Cadastro de Produtos
require_page('products/edit/*', 'pages/products/product_edit.php');
/*
 * Categorias
 */
//Listagem de Categorias
require_page('products/categories', 'pages/products/pr_categories.php');
//Cadastro de Categoria
require_page('products/category/add', 'pages/products/pr_category_add.php');
//Edição de categoria
require_page('products/category/edit/*', 'pages/products/pr_category_edit.php');
//Exclusão de Categoria
require_page('products/category/delete/*', 'pages/products/pr_categories.php');