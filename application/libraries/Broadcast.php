<?php

class Broadcast
{
  /**
   * Menyebarkan sinyal websocket ke semua user sesuai event yang sudah diefinisikan.
   * Returns a new instance of the Pusher class with the provided credentials and options.
   * @return Pusher\Pusher A new instance of the Pusher class.
   */
  public static function pusher()
  {
    return new Pusher\Pusher(
      $_ENV['PUSHER_APP_KEY'],
      $_ENV['PUSHER_APP_SECRET'],
      $_ENV['PUSHER_APP_ID'],
      [
        'cluster' => 'ap1',
        'useTLS' => true
      ]
    );
  }
}
