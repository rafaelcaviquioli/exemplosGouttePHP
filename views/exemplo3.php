  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Exemplo 3</title>

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
         <h3 class="text-muted">Web Crawler Goutte PHP - <strong>Exemplo 3</strong></h3>
         <nav>
          <ul class="nav nav-justified">
           <li><a href="exemplo1.php">Exemplo 1</a></li>
           <li><a href="exemplo2.php">Exemplo 2</a></li>
           <li class="active"><a href="exemplo3.php">Exemplo 3</a></li>
         </ul>
       </nav>
     </div>

     <!-- Jumbotron -->
     <div class="jumbotron">
       <p class="lead">
        <strong>1. </strong>Usuário digita o nome de um produto interessado e a quantidade de itens desejada.<br />
        <strong>2. </strong>Web Crawler acessa o site http://www.americanas.com.br/<br />
        <strong>3. </strong>Web Crawler navega por cada página do site procurando por links que contenham o produto desejado, ao atingir o número máximo de itens encontrados o sistema exibe os itens na tela.<br />
      </p>
    </div>
    <div class="row">
      <form action="exemplo3.php" method="GET">
        <div class="col-sm-12" style="margin-bottom: 20px">
          <div class="col-sm-9">
            <select class="form-control input-sm" name="categoria">
                <option>Todo site</option>
                <?php
                  foreach ($categorias as $url => $categoriaItem) {
                    echo "<option value='$url' " . ($url == $categoria ? "selected" : null) . ">$categoriaItem</option>";
                  }
                ?>
            </select>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-9">
            <input type="text" class="form-control input-sm" name="busca" placeholder="Buscar..." value="<?php echo empty($busca) ? null : $busca; ?>" />
          </div>
          <div class="col-sm-2">
            <input type="text" class="form-control input-sm" name="limite" placeholder="Limite" value="<?php echo empty($limite) ? null : $limite; ?>" />
          </div>
          <div class="col-sm-1">
            <button type="submit" class="btn btn-success">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
    <?php if(isset($resultados) AND count($resultados) == 0){ ?>
    <div 
    <?php }else{  ?>
    <div class="row">
      <?php foreach ($resultados as $resultado) { ?>
      <div class="col-lg-4" style="height: 300px;">
        <h4><?php echo $resultado['titulo']; ?></h4>
        <?php foreach ($resultado['imagens'] as $imagem) { ?>
        <img src="<?php echo $imagem; ?>" width="200" />
        <p><?php echo $resultado['de']; ?></p>
        <p><?php echo $resultado['por']; ?></p>
        <?php } ?>
        <p><a class="btn btn-primary" href="<?php echo $resultado['link']; ?>" target="_blank" role="button">Ver produto &raquo;</a></p>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  </div>
</body>
</html>
