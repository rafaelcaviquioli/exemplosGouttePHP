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
    			<h3 class="text-muted">Web Crawler Goutte PHP - <strong>Exemplo 2</strong></h3>
    			<nav>
    				<ul class="nav nav-justified">
    					<li><a href="exemplo1.php">Exemplo 2</a></li>
    					<li class="active"><a href="exemplo2.php">Exemplo 2</a></li>
              <li><a href="exemplo3.php">Exemplo 3</a></li>
    					<li><a href="#">Exemplo 4</a></li>
    					<li><a href="#">Exemplo 5</a></li>
    				</ul>
    			</nav>
    		</div>

    		<!-- Jumbotron -->
    		<div class="jumbotron">
    			<p class="lead">
            <strong>1. </strong>Usuário digita um termo de busca<br />
    				<strong>2. </strong>Web Crawler acessa o site https://pt.wikipedia.org/<br />
    				<strong>3. </strong>Web Crawler inseri o termo de busca no campo de busca e simula um clique no botão buscar.<br />
    				<strong>4. </strong>Web Crawler obtem o título, descrição e imagens da página e exibe ao usuário.<br />
    			</p>
    		</div>
        <div class="row">
          <form action="exemplo2.php" method="GET">
              <div class="col-sm-10">
                <input type="text" class="form-control input-sm" name="busca" placeholder="Buscar..." value="<?php echo empty($busca) ? null : $busca; ?>" />
              </div>
              <div class="col-sm-2">
                <button type="submit" class="btn btn-default">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
          </form>
        </div>
        <br />
        <?php if(!is_null($resultado)){ ?>
      		<!-- Example row of columns -->
      		<div class="row">
              <div class="col-sm-12">
              <?php foreach ($resultado->imagens as $imagem) { ?>
                <div class="img-thumbnail">
                  <img src="<?php echo $imagem; ?>" />
                </div>
              <?php } ?>
              </div>
      			<div class="col-lg-12">
      				<h4><?php echo $resultado->titulo; ?></h4>
              <p><?php echo substr(implode("<br />", $resultado->descricao), 0, 5000); ?></p>
      			</div>
      		</div>
        <?php } ?>
    	</div>
    </body>
    </html>
