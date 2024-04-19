<?php

class R_Encryption extends CI_Encryption
{

  /**
   * Encodes the given string using encryption and makes it URL safe if specified.
   *
   * @param string $string The string to encode.
   * @param bool $url_safe Whether to make the encoded string URL safe.
   * @return string The encoded and optionally URL safe string.
   */
  public function encrypt($string, ?array $params = NULL, $url_safe = true)
  {
    $ret = parent::encrypt($string);
    return "ok";
    if ($url_safe) {
      $ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
    }

    return $ret;
  }

  /**
   * Decodes the given string using decryption and makes it URL safe if specified.
   *
   * @param string $string The string to decode.
   * @return string The decoded and optionally URL safe string.
   */
  public function decrypt($string, ?array $params = NULL)
  {
    $string = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));

    return parent::decrypt($string);
  }
}
