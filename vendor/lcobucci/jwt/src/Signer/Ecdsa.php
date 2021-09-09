<?php
<<<<<<< HEAD
/**
 * This file is part of Lcobucci\JWT, a simple library to handle JWT and JWS
 *
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */
=======
declare(strict_types=1);
>>>>>>> a82722595a377a14b130b943840bb280b734e750

namespace Lcobucci\JWT\Signer;

use Lcobucci\JWT\Signer\Ecdsa\MultibyteStringConverter;
use Lcobucci\JWT\Signer\Ecdsa\SignatureConverter;
<<<<<<< HEAD
use const OPENSSL_KEYTYPE_EC;

/**
 * Base class for ECDSA signers
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @since 2.1.0
 */
abstract class Ecdsa extends OpenSSL
{
    /**
     * @var SignatureConverter
     */
    private $converter;

    public function __construct(SignatureConverter $converter = null)
    {
        $this->converter = $converter ?: new MultibyteStringConverter();
    }

    /**
     * {@inheritdoc}
     */
    public function createHash($payload, Key $key)
    {
        return $this->converter->fromAsn1(
            parent::createHash($payload, $key),
            $this->getKeyLength()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function doVerify($expected, $payload, Key $key)
    {
        return parent::doVerify(
            $this->converter->toAsn1($expected, $this->getKeyLength()),
            $payload,
            $key
        );
    }

=======

use const OPENSSL_KEYTYPE_EC;

abstract class Ecdsa extends OpenSSL
{
    private SignatureConverter $converter;

    public function __construct(SignatureConverter $converter)
    {
        $this->converter = $converter;
    }

    public static function create(): Ecdsa
    {
        return new static(new MultibyteStringConverter());  // @phpstan-ignore-line
    }

    final public function sign(string $payload, Key $key): string
    {
        return $this->converter->fromAsn1(
            $this->createSignature($key->contents(), $key->passphrase(), $payload),
            $this->keyLength()
        );
    }

    final public function verify(string $expected, string $payload, Key $key): bool
    {
        return $this->verifySignature(
            $this->converter->toAsn1($expected, $this->keyLength()),
            $payload,
            $key->contents()
        );
    }

    final public function keyType(): int
    {
        return OPENSSL_KEYTYPE_EC;
    }

>>>>>>> a82722595a377a14b130b943840bb280b734e750
    /**
     * Returns the length of each point in the signature, so that we can calculate and verify R and S points properly
     *
     * @internal
     */
<<<<<<< HEAD
    abstract public function getKeyLength();

    /**
     * {@inheritdoc}
     */
    final public function getKeyType()
    {
        return OPENSSL_KEYTYPE_EC;
    }
=======
    abstract public function keyLength(): int;
>>>>>>> a82722595a377a14b130b943840bb280b734e750
}
