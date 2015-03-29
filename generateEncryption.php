<?php
require 'vendor/autoload.php';
$factory = new RandomLib\Factory;
$generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));

$file = new \Arhframe\Util\File(__DIR__ . '/config/key.txt');
$file->setContent($generator->generate(32) . "\n");
$checksum = $file->getHash('md5');
echo "ChecksumKeyFile to add to config.yml: $checksum\n";
$enc = new \Sphring\MicroWebFramework\Util\Encryptor();
$enc->setChecksumFile($checksum);
$enc->setKeyFile(new \Arhframe\Util\File(__DIR__ . '/config/key.txt'));

$encryptKey = bin2hex($enc->xorify($generator->generate(32)));
echo "Export as env var CI_WATCH=$encryptKey\n";