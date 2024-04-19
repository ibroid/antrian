<?php

use PHPCrypter\Encryption\Encryption;

class Cypher extends Encryption
{
  /**
   * Encodes the given string using encryption and makes it URL safe if specified.
   *
   * @param string $string The string to encode.
   * @return string The encoded and optionally URL safe string.
   */
  public static function urlsafe_encrypt($string)
  {
    $ret = parent::encrypt($string, "AES-128-CBC", $_ENV["ENCRYPTION_KEY"]);
    $ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));

    return $ret;
  }

  /**
   * Decodes the given string using decryption and makes it URL safe if specified.
   *
   * @param string $string The string to decode.
   * @return string The decoded and optionally URL safe string.
   */
  public static function urlsafe_decrypt($string)
  {
    $string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));

    return parent::decrypt($string, $_ENV["ENCRYPTION_KEY"]);
  }
}
