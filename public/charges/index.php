<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPIKE Token API demo</title>
    <meta name="author" content="Yuki Matsukura">
    <!-- Bootstrap -->
    <link href="../components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      div.margin {
        margin-bottom: 0.5em;
      }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="padding-top: 50px; ">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="http://matsu.teraren.com/spike-api-demo-php/">SPIKE API demo</a>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>SPIKE Charges demo</h1>


<?php
require '../../vendor/autoload.php';

try {
    $spike = new \Issei\Spike\Spike(trim(file_get_contents('../../secret.key')));

    $charges = $spike->getCharges($pages = 100);

    foreach ($charges as $charge) {
      print sprintf("<h2>%s</h2>", $charge->getId());
      print '<div class="row">';
      print '<div class="col-sm-6">';
      print sprintf('%s %s', $charge->getAmount()->getCurrency(), number_format($charge->getAmount()->getAmount()));
      print '<br>';
      print $charge->getCreated()->format('Y-m-d H:i:s');
      print '</div>';
      print '<div class="col-sm-6">';
      if ($charge->isPaid() && !$charge->isCaptured()) {
        print sprintf('<a href="capture.php?id=%s" class="btn btn-success">Capture</a> ', $charge->getId());
        print sprintf('<a href="refund.php?id=%s" class="btn btn-warning">Auth cancel</a> ', $charge->getId());
      }
      if ($charge->isCaptured()) {
        if (!$charge->isRefunded()) {
          print sprintf('<a href="refund.php?id=%s" class="btn btn-danger">Refund</a> ', $charge->getId());
        }
      }
      print '</div>';
      print '</div>';
    }


} catch (Exception $e) {
    // エラー
    var_dump($e);
}

?>


        </div>
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../components/bootstrap/dist/js/bootstrap.js"></script>

  </body>
</html>



