<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Sample Page</title>
        <meta name="author" content="Yuki Matsukura">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>


<pre>

<?php
require '../../vendor/autoload.php';

try {
    $spike = new \Issei\Spike\Spike(trim(file_get_contents('../../secret.key')));

    $id = $_GET['id'];

    // capture
    $charge = $spike->getCharge($id);
    $charge = $spike->refund($charge);

    var_dump($charge);


} catch (Exception $e) {
    // エラー
    var_dump($e);
}

?>

</pre>
    </body>
    </html>
