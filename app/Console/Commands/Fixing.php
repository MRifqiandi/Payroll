<?php

namespace App\Console\Commands;

use App\Utils;
use Illuminate\Console\Command;

class Fixing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fixing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $keyPair = Utils::GENERATE_RSA_KEY();
        // $publicKey = $keyPair['public_key'];
        // $privateKey = $keyPair['private_key'];

        // echo "Public Key:\n" . $publicKey . "\n";
        // echo "\n\n";
        // echo "Private Key:\n" . $privateKey . "\n";

        // $data = "Hello, RSA encryption!";

        // // Encrypt data with the public key
        // $encrypted = Utils::ENCRYPT_RSA_FILE($data, $publicKey);
        // echo "\n\n";
        // echo "Encrypted Data: " . $encrypted . "\n";

        // // Decrypt data with the private key
        // $decrypted = Utils::DECRYPT_RSA_FILE($encrypted, $privateKey);
        // echo "\n\n";
        // echo "Decrypted Data: " . $decrypted . "\n";


        // Generate a new AES-128 key
        $aesKey = Utils::GENERATE_AES_KEY();
        echo "Generated AES Key: " . $aesKey . "\n";

        // Now you can use this AES key for encryption and decryption
        $data = "Hello, AES encryption!";
        $encryptedAES = Utils::ENCRYPT_AES($data, hex2bin($aesKey)); // Convert hex key back to binary for encryption
        echo "Encrypted AES Data: " . $encryptedAES['data'] . "\n";

        // Decrypt data with AES-128
        $decryptedAES = Utils::DECRYPT_AES($encryptedAES, hex2bin($aesKey)); // Convert hex key back to binary for decryption
        echo "Decrypted AES Data: " . $decryptedAES . "\n";
    }
}
