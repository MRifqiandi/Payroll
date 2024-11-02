<?php

namespace App;

use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\AES;

class Utils
{
    public static function GENERATE_RSA_KEY(): array
    {
        $privateKey = RSA::createKey(2048);
        $publicKey = $privateKey->getPublicKey();

        return [
            'private_key' => $privateKey->toString('PKCS1'), // Export as PKCS1 format
            'public_key' => $publicKey->toString('PKCS1'),
        ];
    }

    public static function ENCRYPT_RSA(string $data, string $publicKey): string|false
    {
        $publicKey = PublicKeyLoader::load($publicKey);
        $encryptedData = $publicKey->encrypt($data);
        return base64_encode($encryptedData);
    }

    public static function DECRYPT_RSA(string $data, string $privateKey): string|false
    {
        $privateKey = PublicKeyLoader::load($privateKey);
        $encryptedData = base64_decode($data);
        return $privateKey->decrypt($encryptedData);
    }

    public static function GENERATE_AES_KEY(): string
    {
        return bin2hex(random_bytes(16));
    }

    public static function ENCRYPT_AES(string $data, string $key): array|false
    {
        $aes = new AES('cbc');
        $aes->setKey(substr($key, 0, 16));
        $iv = random_bytes(16);
        $aes->setIV($iv);

        $encryptedData = $aes->encrypt($data);

        return [
            'iv' => base64_encode($iv),
            'data' => base64_encode($encryptedData)
        ];
    }

    public static function DECRYPT_AES(array $data, string $key): string|false
    {
        $aes = new AES('cbc');
        $aes->setKey(substr($key, 0, 16));
        $iv = base64_decode($data['iv']);
        $aes->setIV($iv);

        $encryptedData = base64_decode($data['data']);
        return $aes->decrypt($encryptedData);
    }
}
