<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Exemplo 1</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style type="text/css">
      .active {
      	font-weight: bold;
      	font-size: 18px
      }
      </style>
  </head>

  <body>

  	<div class="container">
  		<div class="masthead">
  			<h3 class="text-muted">Web Crawler Goutte PHP - <strong>Exemplo 1</strong></h3>
  			<nav>
  				<ul class="nav nav-justified">
  					<li class="active"><a href="exemplo1.php">Exemplo 1</a></li>
  					<li><a href="exemplo2.php">Exemplo 2</a></li>
            <li><a href="exemplo3.php">Exemplo 3</a></li>
  				</ul>
  			</nav>
  		</div>

  		<!-- Jumbotron -->
  		<div class="jumbotron">
  			<p class="lead">
  				<strong>1. </strong>Web Crawler acessa o site http://www.itajai.sc.gov.br<br />
  				<strong>2. </strong>Simula um clique sobre o link Notícias<br />
  				<strong>3. </strong>Captura todos os títulos e data da lista de notícias.<br />
  				<strong>4. </strong>Exibe os dados na tela.
  			</p>
  		</div>

  		<!-- Example row of columns -->
  		<div class="row">
  		<?php foreach ($noticias as $noticia) { ?>
  			<div class="col-lg-4">
  				<h4><?php echo $noticia['data'] . " - " . $noticia['titulo']; ?></h4>
  				<p><?php echo $noticia['subtitulo']; ?></p>
  				<p><a class="btn btn-primary" href="<?php echo $url . $noticia['link']; ?>" target="_blank" role="button">Ver Notícia &raquo;</a></p>
  			</div>
  		<?php } ?>
  		</div>
  	</div>
  </body>
  </html>
