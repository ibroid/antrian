<?php

class R_Input extends CI_Input
{

    private static $par;

    public function __construct()
    {
        $sc = new CI_Security(true);
        parent::__construct($sc);
    }

    public static function ci()
    {
        return new static;
    }

    /**
     * Retrieves the POST data from the request, optionally filtering by a specific parameter.
     *
     * @param string|null $par The parameter to filter the POST data by (optional).
     * @return string|\Illuminate\Support\Collection The filtered POST data if a parameter is provided, otherwise the entire POST data.
     */
    public static function pos($par = null)
    {
        return !$par ? collect(self::ci()->post(null, true))  : self::ci()->post($par, TRUE);
    }

    public static function gett($par = null)
    {
        return !$par ? self::ci()->get() : self::ci()->get($par, TRUE);
    }

    public static function mustPost()
    {
        if (self::ci()->method() !== "post") {
            http_response_code(404);
            exit;
        }
    }

    public static function isPost()
    {
        return self::ci()->method() == "post";
    }

    /**
     * Parsing post dari json
     * @return array
     */
    public static function json(): array
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json, TRUE);

        return $data;
    }
}
