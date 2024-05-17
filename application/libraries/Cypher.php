<?php

use PHPCrypter\Encryption\Encryption;
use Hashids\Hashids;

class Cypher
{
  /**
   * Encodes the given string using encryption and makes it URL safe if specified.
   *
   * @param string $string The string to encode.
   * @return string The encoded and optionally URL safe string.
   */
  public static function urlsafe_encrypt($string)
  {
    $hashids = new Hashids();

    return $hashids->encode($string);
  }

  /**
   * Decodes the given string using decryption and makes it URL safe if specified.
   *
   * @param string $string The string to decode.
   * @return string The decoded and optionally URL safe string.
   */
  public static function urlsafe_decrypt($string)
  {
    $hashids = new Hashids();

    return $hashids->decode($string)[0];
  }
}
