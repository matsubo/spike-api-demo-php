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

    $card_number = implode('', array($_POST['cc1'], $_POST['cc2'], $_POST['cc3'], $_POST['cc4']));
    $month = $_POST['month'];
    $year = $_POST['year'];
    $cvc = $_POST['cvc'];
    $name = $_POST['name'];
    $email = $_POST['email'];


    $request = new \Issei\Spike\TokenRequest();
    $request
      ->setCardNumber($card_number)
      ->setExpirationMonth($month)
      ->setExpirationYear($year)
      ->setHolderName($name)
      ->setSecurityCode($cvc)
      ->setCurrency('JPY')
      ->setEmail($email)
      ;

    $token = $spike->requestToken($request);


    // 課金を作成
    $request = new \Issei\Spike\ChargeRequest();
    $request
      ->setToken($token)
      ->setAmount(666, 'JPY')
      ->setCapture(false) // If you set false, you can delay capturing.
      ;

    $product = new \Issei\Spike\Model\Product('my-product-00001');
    $product
      ->setTitle('Product Name')
      ->setDescription('Description of Product.')
      ->setPrice(333, 'JPY')
      ->setLanguage('JA')
      ->setCount(2)
      ->setStock(97)
      ;

    $request->addProduct($product);

    $charge = $spike->charge($request);

    var_dump($charge);


    // 課金を確定
    $charge = $spike->capture($charge);
    var_dump($charge);

    // 課金を取り消し
    $response = $spike->refund($charge);
    var_dump($response);


} catch (Exception $e) {
    // エラー
    var_dump($e);
}

?>

</pre>
    </body>
    </html>
