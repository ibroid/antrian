<?php

class Broadcast
{
  /**
   * Returns a new instance of the Pusher class with the provided credentials and options.
   * @return Pusher\Pusher A new instance of the Pusher class.
   */
  public static function pusher()
  {
    return new Pusher\Pusher(
      getenv('PUSHER_APP_KEY'),
      getenv('PUSHER_APP_SECRET'),
      getenv('PUSHER_APP_ID'),
      [
        'cluster' => 'ap1',
        'useTLS' => true
      ]
    );
  }
}
