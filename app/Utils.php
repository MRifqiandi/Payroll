<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\AES;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Utils
{
    public static function ENCRYPT_SLIP($file, $key): array
    {
        $aesKey = self::GENERATE_AES_KEY();
        $encryptedData = self::ENCRYPT_AES(json_encode($file), $aesKey);
        $encryptedKey = self::ENCRYPT_RSA($aesKey, $key);

        return [
            'file' => $encryptedData['data'],
            'iv' => self::ENCRYPT_ENV($encryptedData['iv']),
            'key' => $encryptedKey,
        ];
    }

    public static function DECRYPT_SLIP($file, $aesKey, $iv, $privateKey)
    {
        try {
            $privateKey = self::DECRYPT_ENV($privateKey);
            $aesKey = self::DECRYPT_RSA($aesKey, $privateKey);
            $iv = self::DECRYPT_ENV($iv);

            $decryptedData = json_decode(json_decode(self::DECRYPT_AES($file, $iv, $aesKey)));

            return $decryptedData;
        } catch (\Throwable $th) {
            throw new HttpException(403, 'Invalid key');
        }
    }

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
        /** @var mixed $publicKey */
        $publicKey = PublicKeyLoader::load($publicKey);

        $encryptedData = $publicKey->encrypt($data);
        return base64_encode($encryptedData);
    }

    public static function DECRYPT_RSA(string $data, string $privateKey): string|false
    {
        /** @var mixed $privateKey */
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

    public static function DECRYPT_AES(string $data, string $iv, string $key): string|false
    {
        $aes = new AES('cbc');
        $aes->setKey(substr($key, 0, 16));
        $iv = base64_decode($iv);
        $aes->setIV($iv);

        $encryptedData = base64_decode($data);
        return $aes->decrypt($encryptedData);
    }

    public static function ENCRYPT_ENV($data)
    {
        return Crypt::encryptString($data);
    }

    public static function DECRYPT_ENV($data)
    {
        return Crypt::decryptString($data);
    }

    public static function GENERATE_2FA_SECRET(): string
    {
        return (new Google2FA())->generateSecretKey();
    }

    public static function GET_2FA_QRCODE(string $name, string $secret): string
    {
        $writer = new Writer(new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        ));

        return $writer->writeString(
            (new Google2FA())->getQRCodeUrl(
                config('app.name'),
                $name,
                $secret
            )
        );
    }

    public static function VERIFY_2FA(string $secret, string $code)
    {
        return (new Google2FA())->verifyKey($secret, $code);
    }

    public static function CREATE_ENV_VARIABLE($key, $value)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        $envContent = preg_replace("/^{$key}=.*$/m", '', $envContent);

        $envContent .= "\n{$key}={$value}";

        file_put_contents($envPath, $envContent);
    }

    public static function GENERATE_API_KEY()
    {
        return "SGJI_" . bin2hex(random_bytes(15)) . "_ITK";
    }

    public static function VERIFY_API_KEY($client, $key)
    {
        try {
            $client = base64_decode($client);
            $key = self::DECRYPT_ENV($key);

            return $client == $key;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function STORE_VALIDATED_DEVICE()
    {
        $cacheKey = 'validated_device_' . auth()->id() . '_' . md5(self::GET_DEVICE_INFO());
        Cache::put($cacheKey, true, now()->addDays(1));
    }

    public static function GET_DEVICE_INFO()
    {
        $agent = new Agent();
        return $agent->device() . '|' . $agent->platform() . '|' . $agent->browser();
    }

    public static function IS_DEVICE_VALIDATED()
    {
        $cacheKey = 'validated_device_' . auth()->id() . '_' . md5(self::GET_DEVICE_INFO());
        return Cache::has($cacheKey);
    }
}
