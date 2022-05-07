<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client;
$body = '';
try {
    $res = $client->get('https://quotes.rest/qod?language=en');
    $contents = $res->getBody()->getContents();
    $contents = json_decode($contents, true);
    $quote = $contents['contents']['quotes'][0]['quote'];
    $quote = '**' . $quote . '**' . "\n\n";
    $author = $contents['contents']['quotes'][0]['author'];
    $author = '*"' . $author . '"*';

    $body = $quote . $author;
} catch (Exception $e) {
    $body = $e->getMessage();
}

file_put_contents("README.md", $body);