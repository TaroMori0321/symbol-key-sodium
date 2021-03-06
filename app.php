<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

// キーペア作成
$key_pair = \Haikara\SymbolKeySodium\KeyPair::create();

// 秘密鍵と公開鍵を取り出す
$sk = $key_pair->getSecret();
$pk = $key_pair->getPublic();

// メッセージに秘密鍵で署名
$message = 'PHPerでもブロックチェーンでなんかしたい！';
$signed_message = $sk->sign($message);

// 署名済みメッセージを公開鍵で検証
$opend_message = $pk->verify($signed_message);

// 検証できたら元の文字列が出力される。
echo $opend_message . PHP_EOL;

/*
  この上下のプログラムは同じ動作になる
*/

// キーペア作成
$key_pair = sodium_crypto_sign_keypair();

// 秘密鍵と公開鍵を取り出す
$sk = sodium_crypto_sign_secretkey($key_pair);
$pk = sodium_crypto_sign_publickey($key_pair);

// 署名
$message = 'PHPerでもブロックチェーンでなんかしたい！';
$signed_message = sodium_crypto_sign($message, $sk);

// 検証
$opend_message = sodium_crypto_sign_open($signed_message, $pk);

// 検証できたら元の文字列が出力される。
echo $opend_message . PHP_EOL;
