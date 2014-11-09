<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<?php

		/*
			Quando [definition] for html, o título da página precisa ser inseriodo manualmente
			Utilie as funções de título para otimizar o site (SEO)
		 */
		$title = array('home' => '| Seja bem vindo',
			           'site' => array('produto-1' => '| Produto 1',
			           	                   'produto-2' => '| Produto 2',
			           	                   'produto-3' => '| Produto 3',
			           	                   'produto-4' => '| Produto 4',
			           	                   'default'   => '| Produtos'),
			           'about' => '| Sobre nós');

		set_title($title);
	?>
	<title>:) <?php get_title() ?></title>
	<?php
		/*
			CSS
		 */
		get_head();
	?>
</head>
<body>
	<div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li <?= (require_page('home')) ? 'class="active"' : '' ?> ><a href="<?=base_url()?>home">Home</a></li>
          <li <?= (require_page('about')) ? 'class="active"' : '' ?>><a href="<?=base_url()?>about">About</a></li>
          <li <?= (require_page('site') || require_page('site/*')) ? 'class="active"' : '' ?>><a href="<?=base_url()?>products">Products</a></li>
        </ul>
        <h3 class="text-muted">We Framework </h3>
      </div>
      
      <?php
	  	//Testa a página que está sendo visualizada e inclui um arquivo
		// NOTA: O segundo argumento é opcional
	  	require_page('home', 'pages/home/slide.php');
	  ?>
