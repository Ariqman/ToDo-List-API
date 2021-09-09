<?php
<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> a82722595a377a14b130b943840bb280b734e750
namespace Lcobucci\JWT\Signer\Ecdsa;

/**
 * Manipulates the result of a ECDSA signature (points R and S) according to the
 * JWA specs.
 *
 * OpenSSL creates a signature using the ASN.1 format and, according the JWA specs,
 * the signature for JWTs must be the concatenated values of points R and S (in
 * big-endian octet order).
 *
 * @internal
 *
 * @see https://tools.ietf.org/html/rfc7518#page-9
 * @see https://en.wikipedia.org/wiki/Abstract_Syntax_Notation_One
 */
interface SignatureConverter
{
    /**
     * Converts the signature generated by OpenSSL into what JWA defines
     *
<<<<<<< HEAD
     * @param string $signature
     * @param int $length
     *
     * @return string
     */
    public function fromAsn1($signature, $length);
=======
     * @throws ConversionFailed When there was an issue during the format conversion.
     */
    public function fromAsn1(string $signature, int $length): string;
>>>>>>> a82722595a377a14b130b943840bb280b734e750

    /**
     * Converts the JWA signature into something OpenSSL understands
     *
<<<<<<< HEAD
     * @param string $points
     * @param int $length
     *
     * @return string
     */
    public function toAsn1($points, $length);
=======
     * @throws ConversionFailed When there was an issue during the format conversion.
     */
    public function toAsn1(string $points, int $length): string;
>>>>>>> a82722595a377a14b130b943840bb280b734e750
}
