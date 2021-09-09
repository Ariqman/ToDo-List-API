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

namespace Lcobucci\JWT\Signer\Ecdsa;

use Lcobucci\JWT\Signer\Ecdsa;

<<<<<<< HEAD
/**
 * Signer for ECDSA SHA-512
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @since 2.1.0
 */
class Sha512 extends Ecdsa
{
    /**
     * {@inheritdoc}
     */
    public function getAlgorithmId()
=======
use const OPENSSL_ALGO_SHA512;

final class Sha512 extends Ecdsa
{
    public function algorithmId(): string
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        return 'ES512';
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getAlgorithm()
    {
        return 'sha512';
    }

    /**
     * {@inheritdoc}
     */
    public function getKeyLength()
=======
    public function algorithm(): int
    {
        return OPENSSL_ALGO_SHA512;
    }

    public function keyLength(): int
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        return 132;
    }
}
