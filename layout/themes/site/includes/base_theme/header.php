<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="Fornecedor de Moldes de Silicione Online desde 1995" />
    <meta name="author" content="DECWEB - WEbsites Criativos" />
	<?php

		/*
			Quando [definition] for html, o título da página precisa ser inseriodo manualmente
			Utilie as funções de título para otimizar o site (SEO)
		 */
		$title = array('home' => '| Moldes de Silicone desde 1995',
			           'site' => array('produto-1' => '| Produto 1',
			           	                   'produto-2' => '| Produto 2',
			           	                   'produto-3' => '| Produto 3',
			           	                   'produto-4' => '| Produto 4',
			           	                   'default'   => '| Produtos'),
			           'about' => '| Sobre nós',
					   'contact' => '| Fale Conosco');
		set_title($title);
	?>
	<title>Acquacolor -
	<?php get_title() ?>
	</title>
	<?php
		/*
			CSS
		 */
		get_head();
	?>
</head>
<body>
<div class="container"><div class="margin">  

<header>
        <div class="bg-blue"></div>
        <div class="bg-blue" style="height: 185px;">
            <div class="phone">Contato   11 3683-4390</div>
          <div class="nav">
                <ul style="width: 303px; float: left">
                    <li class="menu1"><a href="<?php echo base_url()?>home" >Home</a></li>
                    <li class="menu2"><a href="<?php echo base_url()?>about">Empresa</a></li>
                    <li class="menu3"><a href="<?php echo base_url()?>produtos">Produtos</a></li>
                </ul>
                
                <a href="<?php echo base_url()?>home" class="logo"><img src="<?php echo theme_base_url()?>assets/img/logotipo.png" name="Acquacolor" title="Página  Iinicial" /></a>
                
                <ul style="width: 303px; float: right">
                    <li class="menu4"><a href="<?php echo base_url()?>distributors">Distribuidores</a></li>
                    <li class="menu5"><a href="<?php echo base_url()?>contact">Contato</a></li>
                    <li><a href="<?php echo base_url()?>      ">Entrar</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-blue"></div>                        
       
</header>