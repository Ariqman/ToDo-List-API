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

namespace Lcobucci\JWT\Signer\Hmac;

use Lcobucci\JWT\Signer\Hmac;

<<<<<<< HEAD
/**
 * Signer for HMAC SHA-384
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @since 0.1.0
 */
class Sha384 extends Hmac
{
    /**
     * {@inheritdoc}
     */
    public function getAlgorithmId()
=======
final class Sha384 extends Hmac
{
    public function algorithmId(): string
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        return 'HS384';
    }

<<<<<<< HEAD
    /**
     * {@inheritdoc}
     */
    public function getAlgorithm()
=======
    public function algorithm(): string
>>>>>>> a82722595a377a14b130b943840bb280b734e750
    {
        return 'sha384';
    }
}
