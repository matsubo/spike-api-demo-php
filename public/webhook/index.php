<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPIKE Webhook demo</title>
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
        <h1>SPIKE Webhook demo</h1>
<?php
$url = (($_SERVER["HTTPS"] == 'on') ? 'https' : 'http') . '://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER['DOCUMENT_URI']) . '/endpoint.php';
?>

<ol>
  <li><code><?php print $url; ?></code>を<a href="https://spike.cc/dashboard/developer/webhook/urls" target="_blank">SPIKEのWebhook登録ページ</a>にて登録します。</li>
  <li>テストのためにPINGボタンを押してテスト送信します</li>。
  <li>このページをリロードすると、Webhookで受信し内容が以下に表示されます。</li>。
</ol>

<h2>Webhookで受信した内容</h2>

<pre>
<?php

require '../../vendor/autoload.php';


$redis = new Predis\Client;

$redis_key = sha1_file('endpoint.php');

print_r(unserialize($redis->get($redis_key)));


?></pre>


        </div>
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../components/bootstrap/dist/js/bootstrap.js"></script>

  </body>
</html>



