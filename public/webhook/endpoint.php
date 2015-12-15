<?php
/**
 * Webhook endpoint
 *
 * @category SPIKE
 * @package  SPIKE
 * @author   Noboru Koike <noboru_koike@metaps.com>
 * @author   Yuki Matsukura <matsubokkuri@gmail.com>
 * @license  GPL3  http://opensource.org/licenses/gpl-3.0.html
 * @link     https://github.com/metaps/spike-checkout-demo
 */
require '../../vendor/autoload.php';


$redis = new Predis\Client;

$redis_key = sha1_file('endpoint.php');

$value = $redis->get($redis_key);
$data = unserialize($value);

$secret_key = trim(file_get_contents('../../secret.key'));

if (empty($secret_key)) {
  header('HTTP/1.0 400 Bad Request');
  print 'Secret key is not found.';
  exit;
}


$json = file_get_contents('php://input');


// signature check
$signature = base64_encode(hash_hmac('sha256', $json, $secret_key, true));

$data['body'] = $json;
$data['server'] = serialize($_SERVER);
$data['signature_sent'] = $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE'];
$data['signature_expected'] = $signature;

$redis->set($redis_key, serialize($data));

if ($signature != $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE']) {
  header('HTTP/1.0 400 Bad Request');
  print sprintf('signature is invalid. (received:%s) (expected:%s)', $_SERVER['HTTP_X_SPIKE_WEBHOOK_SIGNATURE'], $signature);
  exit;
}


header('HTTP/1.0 200 OK');
print('OK');

