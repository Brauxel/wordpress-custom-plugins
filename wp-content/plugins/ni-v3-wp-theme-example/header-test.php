<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
        <?php wp_head(); ?>
    </head>
    <body id="home" <?php body_class(); ?>>
    	<?php echo file_get_contents(get_bloginfo('template_url'). "/assets/images/social.svg"); ?>
    	
    	<header class="pt-5 pb-5 fixed-top w-100">
    		<div class="container">
				<nav class="navbar navbar-toggleable-lg">
				  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
				  <!--<a class="navbar-brand" href="#">Navbar</a>-->

				  <div class="collapse navbar-collapse navbar-custom fixed-top" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
					  <li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link disabled" href="#">Disabled</a>
					  </li>
					</ul>
					<form class="form-inline my-2 my-lg-0">
					  <input class="form-control mr-sm-2" type="text" placeholder="Search">
					  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
				  </div>
				</nav>
			</div>
    	</header>
    	
    	<main>