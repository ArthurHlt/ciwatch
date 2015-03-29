<?php
/**
 * Copyright (C) 2014 Arthur Halet
 *
 * This software is distributed under the terms and conditions of the 'MIT'
 * license which can be found in the file 'LICENSE' in this package distribution
 * or at 'http://opensource.org/licenses/MIT'.
 *
 * Author: Arthur Halet
 * Date: 29/03/2015
 */

namespace Sphring\MicroWebFramework\Util;


use Arhframe\Util\File;
use Sphring\MicroWebFramework\Exception\MicroWebFrameException;

/**
 * Class Encryptor
 * @package Sphring\MicroWebFramework\Util
 * Try to have a strong encryption/decryption class
 */
class Encryptor
{
    /**
     * @var File
     */
    private $keyFile;
    private $checksumFile;
    private $generatedKey;

    public function encrypt($text)
    {
        $finalKey = $this->xorify(hex2bin($this->generatedKey));
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $finalKey, utf8_encode($text), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    public function decrypt($text)
    {
        $finalKey = $this->xorify(hex2bin($this->generatedKey));
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $finalKey, $text, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

    public function xorify($string)
    {
        if (!$this->keyFile->checksumMd5($this->checksumFile)) {
            throw new MicroWebFrameException("Invalid checksum, security break?");
        }

        $key = rtrim($this->keyFile->getContent());
        $text = $string;
        $outText = '';
        $lenText = strlen($text);
        $lenKey = strlen($key);
        for ($i = 0; $i < $lenText;) {
            for ($j = 0; ($j < $lenKey && $i < $lenText); $j++, $i++) {
                $outText .= $text{$i} ^ $key{$j};
            }
        }
        return $outText;
    }

    /**
     * @return File
     */
    public function getKeyFile()
    {
        return $this->keyFile;
    }

    /**
     * @param File $keyFile
     */
    public function setKeyFile(File $keyFile)
    {
        $this->keyFile = $keyFile;
    }

    /**
     * @return mixed
     */
    public function getGeneratedKey()
    {
        return $this->generatedKey;
    }

    /**
     * @param mixed $generatedKey
     */
    public function setGeneratedKey($generatedKey)
    {
        $this->generatedKey = $generatedKey;
    }

    /**
     * @return mixed
     */
    public function getChecksumFile()
    {
        return $this->checksumFile;
    }

    /**
     * @param mixed $checksumFile
     */
    public function setChecksumFile($checksumFile)
    {
        $this->checksumFile = $checksumFile;
    }

}
