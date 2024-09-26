<?php /** @noinspection EncryptionInitializationVectorRandomnessInspection */

/** @noinspection CryptographicallySecureRandomnessInspection */

namespace PayPal\Security;

class Cipher
{
    const int IV_SIZE = 16;

    public function __construct(private readonly string $secretKey)
    {
    }

    public function encrypt(string $input): string
    {
        // Create a random IV. Not using mcrypt to generate one, as to not have a dependency on it.
        $iv = substr(uniqid('', true), 0, self::IV_SIZE);
        // Encrypt the data
        $strongResult = false;
        $ivRandom = openssl_random_pseudo_bytes(self::IV_SIZE, $strongResult);
        $encrypted = openssl_encrypt(
            $input,
            'AES-256-CBC',
            $this->secretKey,
            0,
            $ivRandom ?: $iv
        );
        // Encode the data with IV as prefix
        return base64_encode($iv . $encrypted);
    }

    public function decrypt(string $input): string
    {
        // Decode the IV + data
        $input = base64_decode($input);
        // Remove the IV
        $iv = substr($input, 0, self::IV_SIZE);
        // Return Decrypted Data
        return openssl_decrypt(substr($input, self::IV_SIZE), 'AES-256-CBC', $this->secretKey, 0, $iv);
    }
}
