<?php
<<<<<<< HEAD
namespace Lcobucci\JWT\Signer;

use InvalidArgumentException;
use Lcobucci\JWT\Signer;
use function assert;
use function is_array;
use function is_resource;
=======
declare(strict_types=1);

namespace Lcobucci\JWT\Signer;

use Lcobucci\JWT\Signer;
use OpenSSLAsymmetricKey;

use function array_key_exists;
use function assert;
use function is_array;
use function is_bool;
use function is_string;
>>>>>>> a82722595a377a14b130b943840bb280b734e750
use function openssl_error_string;
use function openssl_free_key;
use function openssl_pkey_get_details;
use function openssl_pkey_get_private;
use function openssl_pkey_get_public;
use function openssl_sign;
use function openssl_verify;

<<<<<<< HEAD
abstract class OpenSSL extends BaseSigner
{
    public function createHash($payload, Key $key)
    {
        $privateKey = $this->getPrivateKey($key->getContent(), $key->getPassphrase());
=======
abstract class OpenSSL implements Signer
{
    /**
     * @throws CannotSignPayload
     * @throws InvalidKeyProvided
     */
    final protected function createSignature(
        string $pem,
        string $passphrase,
        string $payload
    ): string {
        $key = $this->getPrivateKey($pem, $passphrase);
>>>>>>> a82722595a377a14b130b943840bb280b734e750

        try {
            $signature = '';

<<<<<<< HEAD
            if (! openssl_sign($payload, $signature, $privateKey, $this->getAlgorithm())) {
                throw new InvalidArgumentException(
                    'There was an error while creating the signature: ' . openssl_error_string()
                );
=======
            if (! openssl_sign($payload, $signature, $key, $this->algorithm())) {
                $error = openssl_error_string();
                assert(is_string($error));

                throw CannotSignPayload::errorHappened($error);
>>>>>>> a82722595a377a14b130b943840bb280b734e750
            }

            return $signature;
        } finally {
<<<<<<< HEAD
            openssl_free_key($privateKey);
=======
            $this->freeKey($key);
>>>>>>> a82722595a377a14b130b943840bb280b734e750
        }
    }

    /**
<<<<<<< HEAD
     * @param string $pem
     * @param string $passphrase
     *
     * @return resource
     */
    private function getPrivateKey($pem, $passphrase)
=======
     * @return resource|OpenSSLAsymmetricKey
     *
     * @throws CannotSignPayload
     */
    private function getPrivateKey(string $pem, string $passphrase)
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        $privateKey = openssl_pkey_get_private($pem, $passphrase);
        $this->validateKey($privateKey);

        return $privateKey;
    }

<<<<<<< HEAD
    /**
     * @param $expected
     * @param $payload
     * @param $pem
     * @return bool
     */
    public function doVerify($expected, $payload, Key $key)
    {
        $publicKey = $this->getPublicKey($key->getContent());
        $result    = openssl_verify($payload, $expected, $publicKey, $this->getAlgorithm());
        openssl_free_key($publicKey);
=======
    /** @throws InvalidKeyProvided */
    final protected function verifySignature(
        string $expected,
        string $payload,
        string $pem
    ): bool {
        $key    = $this->getPublicKey($pem);
        $result = openssl_verify($payload, $expected, $key, $this->algorithm());
        $this->freeKey($key);
>>>>>>> a82722595a377a14b130b943840bb280b734e750

        return $result === 1;
    }

    /**
<<<<<<< HEAD
     * @param string $pem
     *
     * @return resource
     */
    private function getPublicKey($pem)
=======
     * @return resource|OpenSSLAsymmetricKey
     *
     * @throws InvalidKeyProvided
     */
    private function getPublicKey(string $pem)
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        $publicKey = openssl_pkey_get_public($pem);
        $this->validateKey($publicKey);

        return $publicKey;
    }

    /**
     * Raises an exception when the key type is not the expected type
     *
<<<<<<< HEAD
     * @param resource|bool $key
     *
     * @throws InvalidArgumentException
     */
    private function validateKey($key)
    {
        if (! is_resource($key)) {
            throw new InvalidArgumentException(
                'It was not possible to parse your key, reason: ' . openssl_error_string()
            );
        }

        $details = openssl_pkey_get_details($key);

        if (! isset($details['key']) || $details['type'] !== $this->getKeyType()) {
            throw new InvalidArgumentException('This key is not compatible with this signer');
        }
    }

=======
     * @param resource|OpenSSLAsymmetricKey|bool $key
     *
     * @throws InvalidKeyProvided
     */
    private function validateKey($key): void
    {
        if (is_bool($key)) {
            $error = openssl_error_string();
            assert(is_string($error));

            throw InvalidKeyProvided::cannotBeParsed($error);
        }

        $details = openssl_pkey_get_details($key);
        assert(is_array($details));

        if (! array_key_exists('key', $details) || $details['type'] !== $this->keyType()) {
            throw InvalidKeyProvided::incompatibleKey();
        }
    }

    /** @param resource|OpenSSLAsymmetricKey $key */
    private function freeKey($key): void
    {
        if ($key instanceof OpenSSLAsymmetricKey) {
            return;
        }

        openssl_free_key($key); // Deprecated and no longer necessary as of PHP >= 8.0
    }

>>>>>>> a82722595a377a14b130b943840bb280b734e750
    /**
     * Returns the type of key to be used to create/verify the signature (using OpenSSL constants)
     *
     * @internal
     */
<<<<<<< HEAD
    abstract public function getKeyType();
=======
    abstract public function keyType(): int;
>>>>>>> a82722595a377a14b130b943840bb280b734e750

    /**
     * Returns which algorithm to be used to create/verify the signature (using OpenSSL constants)
     *
     * @internal
     */
<<<<<<< HEAD
    abstract public function getAlgorithm();
=======
    abstract public function algorithm(): int;
>>>>>>> a82722595a377a14b130b943840bb280b734e750
}
