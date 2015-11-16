<?php
// including the config file
include('config.php');
$pdo = connect();
// select all members
$sql = 'SELECT * FROM lista ORDER BY id ASC';
$query = $pdo->prepare($sql);
$query->execute();
$count = $query->rowCount();

$list = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ferramenta de exportação de arquivo</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap-3.3.4/css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome-4.3.0/css/font-awesome.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Ferramenta de exportação de arquivo</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="ajuda.php"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Ajuda</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
    </p>
        <div class="panel panel-default">
        <div class="panel-heading"><b><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Parâmetros</b></div>
        <div class="panel-body">

        <form class="form-horizontal">
          <div class="form-group">
            <label for="Banco" class="col-sm-1 control-label">Banco</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Banco" value="756" readonly>
            </div>
            <label for="Data" class="col-sm-1 control-label">Data</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Data" value=<?php echo date('d/m/Y', strtotime($data)); ?> readonly>
            </div>
            <label for="Conveniada" class="col-sm-1 control-label">Conveniada</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Conveniada" value="009457" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="Cooperativa" class="col-sm-1 control-label">Cooperativa</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Cooperativa" value="3027" readonly>
            </div>
            <label for="Descrição" class="col-sm-1 control-label">Descrição</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Descrição" value="UNIMED    " readonly>
            </div>
            <label for="Conta" class="col-sm-1 control-label">Conta</label>
            <div class="col-xs-2">
              <input type="text" class="form-control input-sm" id="Conta" value="03" readonly>
            </div>
          </div>
        </form>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading"><b><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Enviar & Processar Arquivo</b></div>
        <div class="panel-body">

        <div class="row">
          <div class="col-md-6">
              <!-- Upload Form column -->
              <form action="import.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="file" name="csv_file" id="csv_file" >
              </div>
                    <input type="submit" class="btn btn-success" value="Limpar base e processar o arquivo" id="upload_btn">
              </form>
          </div>
          <div class="col-md-6">
              <!-- Upload Form column -->
              <p>Após enviar o arquivo desejado, clique no botão abaixo para exportar o arquivo no formato <abbr title=" Arquivos Texto comum" class="initialism">TXT</abbr>. Salve o arquivo no computador e faça importação no SISBR.</p>
              <p><a class="btn btn-success" href="export.php" role="button">Gerar Arquivo TXT</a></p>
         </div>
        </div>
        </div>
      </div>
        
      <div class="panel panel-default">
          <div class="panel-heading"><b><span class="glyphicon glyphicon-th" aria-hidden="true"></span> Registros</b></div>
          <div class="panel-body">
          <?php print("Quantidade de registros importados: <span class=\"badge\">$count</span> \n"); ?>
          </p>
          <table class="table">
              <tr>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Conta</th>                            
                  <th>Valor</th>
              </tr>
              <?php
                  $bg = 'bg_1';
                  foreach ($list as $rs) {
                      ?>
                      <tr class="<?php echo $bg; ?>">
                          <td><?php echo $rs['nome']; ?></td>
                          <td><?php echo $rs['cpf']; ?></td>
                          <td><?php echo $rs['conta']; ?></td>
                          <td><?php echo $rs['valor']; ?></td>
                      </tr>
                      <?php
                      if ($bg == 'bg_1') {
                          $bg = 'bg_2';
                      } else {
                          $bg = 'bg_1';
                      }
                  }
              ?>
          </table>
          </div>
        </div>      

      <footer>
        <p>&copy; Sicoob Crediriodoce - Gerencia de Tecnologia da Informação - 2015</p>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="css/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
